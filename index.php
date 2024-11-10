
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files Download</title>
</head>
<body>
    <form method="post" action="scripts/script.php">
        <table>
            <tr>
                <th>teste</th>
                <th>Arquivo</th>
            </tr>

            <tr>
                <td><input type='checkbox' name='fileOp[]' value="user"></td>;
                <td>users.csv</td>
            </tr>

            <tr>
                <td><input type='checkbox' name='fileOp[]' value="tagExpense"></td>;
                <td>tagExpense.csv</td>
            </tr>

            <tr>
                <td><input type='checkbox' name='fileOp[]' value="expense"></td>;
                <td>expense.csv</td>
            </tr>

            <tr>
                <td><input type='checkbox' name='fileOp[]' value="expense"></td>;
                <td>asset.csv</td>
            </tr>

            <tr>
                <td><input type='checkbox' name='fileOp[]' value="expense"></td>;
                <td>tagAsset.csv</td>
            </tr>
        </table>
        <input type="submit" value="Download">
    </form>
</body>
</html>
