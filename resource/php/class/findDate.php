<?php
require_once 'BusinessDayCalculator.php';

class findDate{
    public $dateApplied;
    public $application;
    function __construct($da=null,$application=null) {
    $this->dateApplied = $da;
    $this->application = $application;
    }

    public function findDueDate(){
        var_dump($this->application);
        $applications = explode(',',$this->application);
        var_dump($applications);

        if (in_array("DIPLOMA", $applications)) {
            $calculator = new BusinessDaysCalculator(
                new DateTime($this->dateApplied), // Today
                [new DateTime("2014-06-01"), new DateTime("2014-06-02")],
                [BusinessDaysCalculator::SUNDAY]
            );
            return $date = $calculator->addBusinessDays(21);
        }else if(in_array("CAV CEU", $applications) || in_array("TC/TR", $applications) || in_array("TC/SR", $applications)){
              $calculator = new BusinessDaysCalculator(
                  new DateTime($this->dateApplied), // Today
                  [new DateTime("2014-06-01"), new DateTime("2014-06-02")],
                  [BusinessDaysCalculator::SUNDAY]
              );
              return $date = $calculator->addBusinessDays(21);
        }else if(in_array("TOR", $applications) || in_array("TC/TR", $applications) || in_array("TC/SR", $applications)){
          $calculator = new BusinessDaysCalculator(
              new DateTime($this->dateApplied), // Today
              [new DateTime("2014-06-01"), new DateTime("2014-06-02")],
              [BusinessDaysCalculator::SUNDAY]
          );
          return $date = $calculator->addBusinessDays(10);
        }else{
              $calculator = new BusinessDaysCalculator(
                  new DateTime($this->dateApplied), // Today
                  [new DateTime("2014-06-01"), new DateTime("2014-06-02")],
                  [BusinessDaysCalculator::SUNDAY]
              );
              return $date = $calculator->addBusinessDays(3);
          }

        }

        public function findDueDateV(){
                  $calculator = new BusinessDaysCalculator(
                      new DateTime($this->dateApplied), // Today
                      [new DateTime("2014-06-01"), new DateTime("2014-06-02")],
                      [BusinessDaysCalculator::SUNDAY]
                  );
                  return $date = $calculator->addBusinessDays(3);
            }

    }




// Add three business days


 ?>
