<?php

    trait LoggerA {
        public function log() {

        }
    }

    trait LoggerB {
        public function log() {
            
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