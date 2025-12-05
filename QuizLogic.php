<?php
class QuizLogic {
    private $questions = [];
    private $answers = [];
    private $username = "Pengguna";
    
    public function __construct(string $username) {
        $this->username = htmlspecialchars($username);

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
    
    public function setAnswer(int $number, string $answer) {
        $this->answers[$number] = $answer;
    }

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
    
    public function calculateResult(): string {

        $score_dry = 0;
        $score_normal = 0;
        $score_combo = 0;
        $score_oily = 0;
        
        foreach ($this->answers as $ans) {
            
            $l = strtolower($ans);

            if (strpos($l, "kering") !== false) $score_dry++;
            if ($ans === "Normal" || $ans === "Seimbang") $score_normal++;
            if (strpos($ans, "T-zone") !== false) $score_combo++;
            if (strpos($l, "berminyak") !== false) $score_oily++;
        }
        
        $max = max($score_dry, $score_normal, $score_combo, $score_oily);
        
        if ($max == $score_dry) {
            return "Kulit Kering (Kering kerontang, kulitmu butuh hidrasi ekstra!)";
        } elseif ($max == $score_normal) {
            return "Kulit Normal (Selamat! Kulitmu stabil dan sehat!)";
        } elseif ($max == $score_combo) {
            return "Kulit Kombinasi (T-zone berminyak, area lain cenderung normal/kering.)";
        } else {
            return "Kulit Berminyak (Produksi sebum tinggi, tapi glowing alami!)";
        }
    }
}
