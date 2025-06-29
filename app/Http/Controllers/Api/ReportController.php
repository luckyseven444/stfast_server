<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JournalEntry;

class ReportController extends Controller
{
    public function financial(Request $request)
    {
        $startDate = $request->query('from');
        $endDate   = $request->query('to');

        $entries = JournalEntry::with('journal')
            ->whereHas('journal', function ($query) use ($startDate, $endDate) {
                if ($startDate) {
                    $query->whereDate('created_at', '>=', $startDate);
                }
                if ($endDate) {
                    $query->whereDate('created_at', '<=', $endDate);
                }
            });

        $totalSales = (clone $entries)
            ->where('account_name', 'Sales Revenue')
            ->sum('credit');

        $totalExpenses = (clone $entries)
            ->where('account_name', 'Discount Given')
            ->sum('debit');

        $profit = $totalSales - $totalExpenses;

        return response()->json([
            'total_sales'    => round($totalSales, 2),
            'total_expenses' => round($totalExpenses, 2),
            'profit'         => round($profit, 2),
        ]);
    }
}

