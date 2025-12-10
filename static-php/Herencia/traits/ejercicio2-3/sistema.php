<?php

    trait LoggerA {
        public function log() {
            echo "logger A <br>";
        }
    }

    trait LoggerB {
        public function log() {
            echo "logger B <br>";
        }
    }

    class Sistema {
        use LoggerA, LoggerB {
            LoggerA::log insteadof LoggerB; // Prioriza LoggerA
            LoggerB::log as logSecundario;  // Alias opcional para usar el de B
        }
    }

    $s = new Sistema();
    $s->log();   // Usa LoggerA
    $s->logSecundario();  // Usa LoggerB

?>