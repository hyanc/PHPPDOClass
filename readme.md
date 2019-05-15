# PHPPDOClass
PHP Data Object Class. Query method return associative array:
- Match (return all data in array)
- Count (return number of rows data)
- Cols (return columns data)
- Error & SQL


*Numeric second parameter return content of one cell result

### Initialize
```PHP
include('pdo.php');
$sql = new Database('dbName');
```

### Sample 1. Basic print_r output
```PHP
$q = $sql->query("select 'frog' as animal, 'hop' as ability");

print_r($q);

/*result
Array
(
    [count] => 1
    [sql] => select 'frog' as animal, 'hop' as ability
    [cols] => Array
        (
            [0] => animal
            [1] => ability
        )

    [match] => Array
        (
            [0] => Array
                (
                    [animal] => frog
                    [ability] => hop
                )

        )

)
*/
```

### Sample 2. HTML table layout
```PHP
$q = $sql->query("select 'frog' as animal, 'hop' as ability");

echo "<table>";
foreach($q['cols'] as $cols => $col) {
	echo "<th>".$col."</th>";
}
foreach($q['match'] as $rows => $row) {
	echo "<tr>";
	foreach($row as $data) {
		echo "<td>".$data."</td>";
	}
	echo "</tr>";
}
echo "</table>";
```

### Sample 3. One cell result
```PHP
//second parameter is row number
echo $sql->query("select 'frog' as animal, 'hop' as ability",0);
// frog
```

### Sample 4. Error handling
```PHP
$q = $sql->query("select 'frog as animal, 'hop' as ability");
if(isset($q['error'])) echo $q['error'];
```
