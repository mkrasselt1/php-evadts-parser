<?php

namespace PeanutPay\PhpEvaDts;

class CoinTubeLevelDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinSum",
        2 => "blockNo",
        3 => "block0",
        4 => "block1",
        5 => "block2",
        6 => "block3",
        7 => "block4",
        8 => "block5",
        9 => "block6",
        10 => "block7",
    ];

    public $coinSum = 0;
    public $blockNo = "";
    public $block0 = "";
    public $block1 = "";
    public $block2 = "";
    public $block3 = "";
    public $block4 = "";
    public $block5 = "";
    public $block6 = "";
    public $block7 = "";

    public function __toString()
    {
        return "coin tube:\t " . ($this->coinSum / 100) . "\t" .
            ($this->blockNo == 1
                ?
                "0: $this->block0 \t1: $this->block1 \t2: $this->block2 \t3: $this->block3 \t4: $this->block4 \t5: $this->block5 \t6: $this->block6 \t7: $this->block7"
                :
                "7: $this->block0 \t8: $this->block1 \t9: $this->block2 \t10: $this->block3 \t11: $this->block4 \t12: $this->block5 \t13: $this->block6 \t14: $this->block7"
            );
    }
}
