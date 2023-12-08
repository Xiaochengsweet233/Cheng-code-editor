<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $language = $_POST['language'];

    // 执行代码并获取结果
    $result = '';
    if ($language === 'php') {
        ob_start();
        eval($code);
        $result = ob_get_clean();
    } elseif ($language === 'javascript') {
        $result = '<script>' . $code . '</script>';
    } elseif ($language === 'python') {
        $file = fopen("temp.py", "w");
        fwrite($file, $code);
        fclose($file);

        $result = shell_exec("python temp.py");
    } elseif ($language === 'java') {
        $file = fopen("Main.java", "w");
        fwrite($file, $code);
        fclose($file);

        exec('javac Main.java');
        $result = shell_exec('java Main');
    } elseif ($language === 'ruby') {
        $file = fopen("temp.rb", "w");
        fwrite($file, $code);
        fclose($file);

        $result = shell_exec("ruby temp.rb");
    } elseif ($language === 'c') {
        $file = fopen("temp.c", "w");
        fwrite($file, $code);
        fclose($file);

        exec('gcc temp.c -o temp');
        $result = shell_exec('./temp');
    }

    echo $result;
}
?>
