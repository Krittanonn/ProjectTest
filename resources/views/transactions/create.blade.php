<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มรายการรายรับ/รายจ่าย</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-6 text-center">เพิ่มรายการรายรับ/รายจ่าย</h1>

    <!-- แสดง error validation -->
    @if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">ประเภท:</label>
            <select name="type" class="border rounded px-3 py-2 w-full">
                <option value="income" {{ old('type')=='income' ? 'selected':'' }}>รายรับ</option>
                <option value="expense" {{ old('type')=='expense' ? 'selected':'' }}>รายจ่าย</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">ชื่อรายการ:</label>
            <input type="text" name="title" value="{{ old('title') }}" class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <label class="block font-medium">จำนวนเงิน:</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <label class="block font-medium">วันที่ใช้จ่าย:</label>
            <input type="date" name="transaction_date" value="{{ old('transaction_date') }}" class="border rounded px-3 py-2 w-full">
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึก</button>
            <a href="{{ route('transactions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">กลับไปหน้ารายการ</a>
        </div>
    </form>
</div>

</body>
</html>
