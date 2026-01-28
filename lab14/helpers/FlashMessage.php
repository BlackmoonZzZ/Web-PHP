<?php
class FlashMessage {
    public static function add($message, $type = 'success') {
        if (!isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }
        $_SESSION['flash_messages'][] = [
            'message' => $message,
            'type' => $type
        ];
    }
    
    public static function get() {
        if (!isset($_SESSION['flash_messages'])) {
            return [];
        }
        $messages = $_SESSION['flash_messages'];
        unset($_SESSION['flash_messages']);
        return $messages;
    }
    
    public static function display() {
        $messages = self::get();
        if (empty($messages)) return;
        
        foreach ($messages as $msg) {
            $icon = $msg['type'] === 'success' ? '✓' : 'ⓘ';
            $color = $msg['type'] === 'success' ? '#28a745' : '#dc3545';
            echo '<div style="background: ' . $color . '; color: white; padding: 15px; margin-bottom: 20px; border-radius: 5px; display: flex; align-items: center; gap: 10px;">';
            echo '<span style="font-size: 18px;">' . $icon . '</span>';
            echo '<span>' . htmlspecialchars($msg['message']) . '</span>';
            echo '</div>';
        }
    }
}
?>
