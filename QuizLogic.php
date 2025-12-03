<?php
// Modul 5 class definisi
class QuizLogic {
    // Modul 6 buat encapsulation (pake private buat melindungi data)
    private $questions = []; 
    private $answers = [];
    private $username = "Pengguna";

    // Modul 5 constructor
    public function __construct(string $username) {
        $this->username = htmlspecialchars($username);
        
        // Modul 1 pake tipe data array (Menyimpan data pertanyaan)
        $this->questions = [
            1 => ["text" => "Bagaimana kondisi kulitmu saat disentuh?", "options" => ["Kering & kasar", "Normal", "Lembut tapi berminyak", "Sangat berminyak"]],
            2 => ["text" => "Bagaimana kulitmu setelah bangun tidur?", "options" => ["Sangat kering", "Seimbang", "Berminyak di T-zone", "Berminyak seluruh wajah"]],
            3 => ["text" => "Seberapa sering muncul jerawat?", "options" => ["Jarang sekali", "Kadang-kadang", "Sering di T-zone", "Mudah muncul di seluruh wajah"]],
            4 => ["text" => "Bagaimana kondisi pori-pori kulitmu?", "options" => ["Kecil", "Normal", "Besar di T-zone", "Besar di banyak area"]],
            5 => ["text" => "Bagaimana kulitmu bereaksi terhadap cuaca panas?", "options" => ["Tetap kering", "Normal", "Sedikit berminyak", "Sangat berminyak"]],
            6 => ["text" => "Bagaimana kulitmu bereaksi saat cuaca dingin?", "options" => ["Sangat kering", "Sedikit kering", "Normal", "Tetap berminyak"]],
            7 => ["text" => "Bagaimana kondisi kulit setelah memakai skincare?", "options" => ["Tetap kering", "Normal", "Sedikit berminyak", "Berminyak berlebihan"]],
            8 => ["text" => "Apakah kulitmu mudah iritasi?", "options" => ["Sering", "Kadang", "Jarang", "Tidak pernah"]],
            9 => ["text" => "Bagaimana warna kulitmu di area pipi dibanding T-zone?", "options" => ["Lebih gelap di pipi", "Lebih terang di pipi", "Sama saja", "Kemerahan di pipi"]],
            10 => ["text" => "Bagaimana tingkat mengkilap pada wajah di siang hari?", "options" => ["Tidak ada", "Sedikit", "Sedang", "Sangat mengkilap"]],
        ];
    }

    // Modul 4 & 6 pake Setter Method buat simpan jawaban yh
    public function setAnswer(int $number, string $answer) {
        $this->answers[$number] = $answer;
    }
    
    // Modul 6 Getter Method ea
    public function getUsername(): string {
        return $this->username;
    }
    
    public function getQuestion(int $number): array {
        return $this->questions[$number] ?? [];
    }

    public function getTotalQuestions(): int {
        return count($this->questions);
    }
    
    public function getSavedAnswer(int $number): string {
        return $this->answers[$number] ?? "";
    }

    // Modul 4 enih method buat hitung hasil
    public function calculateResult(): string {
        $score_dry = 0; $score_normal = 0; $score_combo = 0; $score_oily = 0;
        
        // Modul 3 pake perulangan (looping) buat hitung skor
        foreach ($this->answers as $ans) {
            // Modul 2 pake pengkondisian (conditional)
            if (str_contains($ans, "kering")) $score_dry++;
            if ($ans == "Normal" || $ans == "Seimbang") $score_normal++;
            if (str_contains($ans, "T-zone")) $score_combo++;
            if (str_contains($ans, "berminyak")) $score_oily++;
        }
        
        $max = max($score_dry, $score_normal, $score_combo, $score_oily);
        
        // Modul 2 enih pengkondisian (If-Else If-Else) buat menentukan hasil
        if ($max == $score_dry) return "Kulit Kering (Kering kerontang, kulitmu butuh hidrasi ekstra! pilih skincare dengan kandungan Hyaluronic Acid, Ceramide, Glycerin, dan Niacinamide untuk menghidrasi dan memperkuat lapisan kulit. Selain itu, bahan seperti Squalane, Shea Butter, Petroleum Jelly, dan ekstrak Lidah Buaya membantu melembapkan dan melindungi kulit.)";
        elseif ($max == $score_normal) return "Kulit Normal (Selamat! Kulitmu udah stabil nih. Kamu bisa pilih skincare dengan kandungan asam hialuronat dan ceramide untuk menjaga kelembapan, niacinamide dan vitamin C untuk mencerahkan serta melindungi kulit. Kandungan seperti retinol dan bakuchiol bisa digunakan untuk manfaat anti-penuaan dini, sementara AHA (seperti glycolic acid) baik untuk mengatasi sel kulit mati dan menghaluskan tekstur.)";
        elseif ($max == $score_combo) return "Kulit Kombinasi (Yuk, fokus rawat T-zone & pipi barengan! Kamu bisa pilih skincare dengan kandungan hyaluronic acid, niacinamide, salicylic acid, dan glycerin. Kandungan-kandungan ini menyeimbangkan kebutuhan kulit yang berbeda, yaitu melembapkan area kering dan mengontrol minyak di area berminyak.)";
        else return "Kulit Berminyak (Wih, glowing banget tapi jaga sebumnya ya! Kamu bisa pilih skincare dengan kandungan Niacinamide, Salicylic Acid (BHA), dan Clay untuk mengontrol minyak dan membersihkan pori-pori. Bahan lain seperti Hyaluronic Acid untuk melembapkan tanpa rasa berat, dan Retinol untuk meregenerasi kulit, juga bisa digunakan. Kandungan antioksidan seperti Vitamin C dan bahan menenangkan seperti Centella Asiatica (Cica) juga bermanfaat.";
    }
}