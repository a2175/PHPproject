<?php
    class BoardService {
        var $param;
        var $boardDAO;

        function __construct($param) {
            $this->param = $param;
            $this->boardDAO = new BoardDAO($this->param);
        }

        function openBoardList() {
            $result['list'] = $this->boardDAO->openBoardList();
            $result['boardCount'] = $this->boardDAO->boardCount();
            return $result;
        }
    }
?>