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

        function openBoardDetail() {
            return $this->boardDAO->openBoardDetail();
        }

        function insertBoard() {
            $values = $_POST;
            unset($values['request']);
            $this->boardDAO->insertBoard($values);
        }

        function updateBoard() {
            $values = $_POST;
            unset($values['request']);
            return $this->boardDAO->updateBoard($values);
        }

        function deleteBoard() {
            return $this->boardDAO->deleteBoard();
        }
    }
?>