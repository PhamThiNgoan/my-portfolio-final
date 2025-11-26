<?php
// Đọc nội dung file quiz.txt
$raw = file_get_contents("quiz.txt");

// Tách từng câu hỏi theo dòng trống
$blocks = preg_split("/\R\R+/", trim($raw));

$questions = [];

foreach ($blocks as $block) {
    $lines = array_filter(array_map("trim", explode("\n", $block)));

    if (count($lines) < 3) continue;

    $question = [
        "question" => "",
        "options" => [],
        "answer" => ""
    ];

    foreach ($lines as $line) {

        // Lấy câu hỏi (dòng không bắt đầu bằng A, B, C, D, ANSWER)
        if (!preg_match("/^[ABCD]\./", $line) && stripos($line, "ANSWER") === false) {
            if ($question["question"] === "") {
                $question["question"] = $line;
            }
            continue;
        }

        // Lấy đáp án lựa chọn
        if (preg_match("/^([ABCD])\.\s*(.*)/", $line, $m)) {
            $question["options"][$m[1]] = $m[2];
        }

        // Lấy đáp án đúng
        if (stripos($line, "ANSWER") !== false) {
            $answer = trim(str_replace("ANSWER:", "", $line));
            $question["answer"] = strtoupper($answer);
        }
    }

    $questions[] = $question;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài Thi Trắc Nghiệm</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        .quiz-container {
            background: white; padding: 20px;
            max-width: 800px; margin: auto;
            border-radius: 10px; box-shadow: 0 0 10px #ccc;
        }
        .question { margin-bottom: 25px; }
        h2 { text-align: center; }
        .correct { color: green; font-weight: bold; }
        .wrong { color: red; font-weight: bold; }
    </style>
</head>
<body>

<div class="quiz-container">
    <h2>BÀI THI TRẮC NGHIỆM</h2>

    <form method="post">
        <?php foreach ($questions as $i => $q): ?>
            <div class="question">
                <p><b>Câu <?= $i + 1 ?>:</b> <?= htmlspecialchars($q["question"]) ?></p>

                <?php foreach ($q["options"] as $key => $text): ?>
                    <label>
                        <input type="radio" name="q<?= $i ?>" value="<?= $key ?>">
                        <?= $key ?>. <?= htmlspecialchars($text) ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit">Nộp bài</button>
    </form>

    <?php
    // XỬ LÝ KẾT QUẢ SAU KHI SUBMIT
    if ($_POST) {
        echo "<h3>Kết quả bài làm:</h3>";
        $correct = 0;

        foreach ($questions as $i => $q) {
            $userAns = $_POST["q$i"] ?? "Không chọn";

            echo "<p><b>Câu ".($i+1).":</b> ";

            if ($userAns == $q["answer"]) {
                echo "<span class='correct'>Đúng ✔</span>";
                $correct++;
            } else {
                echo "<span class='wrong'>Sai ✘</span> (Đáp án đúng: ".$q["answer"].")";
            }

            echo "</p>";
        }

        echo "<h2>Bạn đúng $correct / ".count($questions)." câu</h2>";
    }
    ?>
</div>

</body>
</html>
