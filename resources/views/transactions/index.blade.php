<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบรายรับ-รายจ่าย</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-3xl font-bold mb-6 text-center">ระบบรายรับ-รายจ่ายประจำเดือน</h1>

    <form method="GET" action="{{ route('transactions.index') }}" class="mb-4 flex items-center space-x-2 justify-center">
        <label class="font-medium">เลือกเดือน:</label>
        <input type="month" name="month" value="{{ $month }}" class="border rounded px-2 py-1">
        <button type="submit" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">ค้นหา</button>
        <a href="{{ route('transactions.index') }}" class="ml-2 text-gray-600 hover:underline">รีเซ็ต</a>
    </form>

    <div class="mb-4 flex space-x-2 justify-center">
        <a href="{{ route('transactions.create') }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">เพิ่มรายการใหม่</a>
        <a href="{{ route('transactions.report') }}{{ $month ? '?month='.$month : '' }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">ดูรายงาน</a>
    </div>

    <div class="overflow-x-auto">
        <div class="max-h-96 overflow-y-auto border border-gray-200 rounded">
            <table class="min-w-full bg-white">
                <thead class="sticky top-0 bg-gray-100">
                    <tr class="text-left">
                        <th class="px-4 py-2 border-b">ประเภท</th>
                        <th class="px-4 py-2 border-b">รายการ</th>
                        <th class="px-4 py-2 border-b">จำนวนเงิน</th>
                        <th class="px-4 py-2 border-b">วันที่ใช้จ่าย</th>
                        <th class="px-4 py-2 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $t)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $t->type }}</td>
                        <td class="px-4 py-2 border-b">{{ $t->title }}</td>
                        <td class="px-4 py-2 border-b">{{ number_format($t->amount,2) }}</td>
                        <td class="px-4 py-2 border-b">{{ $t->transaction_date }}</td>
                        <td class="px-4 py-2 border-b space-x-2">
                            <a href="{{ route('transactions.edit',$t->id) }}" class="text-blue-500 hover:underline">แก้ไข</a>
                            <form method="POST" action="{{ route('transactions.destroy',$t->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('ลบรายการนี้?')">ลบ</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center border-b">ไม่มีรายการ</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
