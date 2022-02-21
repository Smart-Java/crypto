<?php
class T{
    private $R1;
    private $R2;
    private $R3;
    private $R4;
    private $R5;

    public function __construct(int $R1, int $R2, int $R3, int $R4, int $R5) {
        $this->R1 = $R1;
        $this->R2 = $R2;
        $this->R3 = $R3;
        $this->R4 = $R4;
        $this->R5 = $R5;
    }

    public function result() {
        $array = array('R1' => $this->R1, 'R2'=>$this->R2, 'R3' => $this->R3, 'R4' => $this-> R4, 'R5'=> $this->R5);
        
        $drawMatch = 0;
        $wonByIndia = 1;
        $wonByEngland = 2;

        $counts = array_count_values($array);
        // $numOfDraws = $counts[$drawMatch];
        $numOfWOnByIndia = $counts[$wonByIndia];
        $numOfWonsByEngland = $counts[$wonByEngland];

        if ($numOfWonsByEngland == $numOfWOnByIndia) {
            echo 'DRAW';
        } else{
            if ($numOfWOnByIndia > $numOfWonsByEngland) {
                echo 'INDIA';
            } else{
                echo 'ENGLAND';
            }
        }
    }
}

$test = new T(0, 1, 2, 1, 0);
$test1 = new T(0, 1, 2, 1, 2);
$test2 = new T(2, 2, 2, 2, 1);
$test->result();
$test1->result();
$test2->result();
?>