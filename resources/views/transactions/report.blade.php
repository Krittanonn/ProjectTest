<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสรุปรายรับ/รายจ่าย</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-3xl font-bold mb-6 text-center">รายงานสรุปรายรับ/รายจ่าย</h1>

    <form method="GET" action="{{ route('transactions.report') }}" class="mb-4 flex items-center space-x-2 justify-center">
        <label class="font-medium">เลือกเดือน:</label>
        <input type="month" name="month" value="{{ $month }}" class="border rounded px-2 py-1">
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">ค้นหา</button>
        <a href="{{ route('transactions.index') }}" class="ml-2 bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">กลับไปหน้ารายการ</a>
    </form>

    @if($transactions->count())
    <div class="overflow-x-auto mb-4">
        <div class="max-h-96 overflow-y-auto border border-gray-200 rounded">
            <table class="min-w-full bg-white">
                <thead class="sticky top-0 bg-gray-100">
                    <tr class="text-left">
                        <th class="px-4 py-2 border-b">ประเภท</th>
                        <th class="px-4 py-2 border-b">รายการ</th>
                        <th class="px-4 py-2 border-b">จำนวนเงิน</th>
                        <th class="px-4 py-2 border-b">วันที่ใช้จ่าย</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $t)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $t->type }}</td>
                        <td class="px-4 py-2 border-b">{{ $t->title }}</td>
                        <td class="px-4 py-2 border-b">{{ number_format($t->amount,2) }}</td>
                        <td class="px-4 py-2 border-b">{{ $t->transaction_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-gray-50 p-4 rounded">
        <h2 class="text-xl font-semibold mb-2">สรุปประจำเดือน</h2>
        <ul class="list-disc pl-5 space-y-1">
            <li>รายรับรวม: {{ number_format($totalIncome,2) }}</li>
            <li>รายจ่ายรวม: {{ number_format($totalExpense,2) }}</li>
            <li>ยอดคงเหลือ: {{ number_format($balance,2) }}</li>
        </ul>
    </div>

    @else
    <p class="text-center text-gray-600">ไม่พบรายการในเดือนนี้</p>
    @endif
</div>

</body>
</html>
