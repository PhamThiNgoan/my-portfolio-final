<?php

// TODO 1: Viết 1 hàm tên là getAllSinhVien()
function getAllSinhVien($pdo) {
    $sql = "SELECT * FROM sinhvien"; //
    $stmt = $pdo->query($sql); //
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // [cite: 53]
}

// TODO 2: Viết 1 hàm tên là addSinhVien()
function addSinhVien($pdo, $ten, $email) {
    $sql = "INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?, ?)"; // [cite: 59]
    $stmt = $pdo->prepare($sql); // [cite: 60]
    $stmt->execute([$ten, $email]); // [cite: 61]
}
?>