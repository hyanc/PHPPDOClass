# PHPPDOClass
PHP Data Object Class. Query method return an associative array:
- Match (return all data in array)
- Count (return number of rows data)
- Cols (return columns data)
- Error & SQL

### Sample 1. Basic print_r output
```PHP
include('pdo.php');
$sql = new SQL();

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
include('pdo.php');
$sql = new SQL();

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