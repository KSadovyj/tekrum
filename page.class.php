<?
class Page{
    var $id;
    var $first_name;
    var $last_name;
    var $title;
    var $age;
    var $birth_date;
   
    function __construct($id = null){
        if($id){
            $id = (int) $id;
            $q = mysql_query("SELECT * FROM users WHERE id = '$id' ") or die(mysql_error());
            if(!mysql_num_rows($q)) die('404'); // если запись не найдена
            $r = mysql_fetch_array($q);

            $this->id = $id;
            $this->first_name = html_entity_decode($r['first_name']);
            $this->last_name = html_entity_decode($r['last_name']);
            $this->title = $this->name . ' | SuperSite';
            $this->age = $r['age'];
            
        }
    }

    function renderForm(){
        $form = <<<HTML
            <form action="action.php" method="POST">
                <p>Имя:</p>
                <p><input name="first_name" type="text"></p>

                <p>Фамилия:</p>
                <p><input name="last_name" type="text"></p>
                
                <p>Возраст:</p>
                <p><input name="age" type="number"></p>
                
                <p>Дата рождения:</p>
                <p><input name="birth_date" type="text"></p>
                
                
                <p><input type="submit" value="Сохранить"></p>
            </form>
HTML;
        echo $form;
    }
    function validateForm($data){
        if(!$data['first_name'] || !$data['last_name'] || !$data['age'] || !$data['birth_date']) die('Заполните все поля!');
        if(!preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/', $data['date'])) die('Неверный формат даты!');
        return true;
    }
    function save($data){
        if(!$this->validateForm($data)) return false;

        $first_name = htmlspecialchars($data['first_name'], ENT_QUOTES);
        $last_name = htmlspecialchars($data['last_name'], ENT_QUOTES);
        $age = $data['age'];
        $birth_date = $data['birth_date'];
      

        $q = mysql_query("INSERT INTO users SET `first_name` = '$first_name', `last_name` = '$last_name', `age` = '$age',
                         'birth_date' = '$birth_date' ") or die(mysql_error());
    }
}
