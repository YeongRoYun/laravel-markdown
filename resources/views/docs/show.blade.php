<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2열 레이아웃</title>
    <style>
        /* 스타일링을 위한 CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
        }

        .column {
            width: 50%;
            padding: 20px;
            box-sizing: border-box;
        }

        /* 선택적으로 각 열에 스타일을 추가할 수 있습니다. */
        .column:nth-child(odd) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="column">
    <!-- 첫 번째 열의 내용 -->
    {!! $index !!}
</div>
<div class="column">
    <!-- 두 번째 열의 내용 -->
    {!! $content !!}
</div>
</body>
</html>
