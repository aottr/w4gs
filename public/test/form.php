<!Doctype>
<H1>Form Test</H1>

<form method="post" action="?run">
    Name <input type="test" name="name" />
    Age <input type="text" name="age" />
    Gender <select name="gender">
        <option value="m">Male</option>
        <option value="f">Female</option>
    </select>
    <input type="submit" />
</form>

<hr>

<pre>
Result:

<?php

require_once '../../library/form.class.php';
require_once '../../library/validate.class.php';

if (isset($_REQUEST['run'])) {
try {
    $form = new Form();

    $form   ->post('name')
            ->val('minlength', 3)
            //->val('fish')
            ->post('age')
            ->val('minlength', 2)
            ->val('digit')
            ->post('gender');
    
    $form   ->submit();

    print_r($form);

    $a = $form->fetch();
    $b = $form->fetch('age');

    print_r($a);

    echo "Field 'age': " . $b;
}
 catch (Exception $e)
 {
    echo $e->getMessage();
 }
}
?>
