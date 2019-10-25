
<!DOCTYPE html><head><title>Login</title></head>
<style>
* { font-family: Calibri, Tahoma, Arial, sans-serif; }
.errmsg { color: red; }
#loginbox { font-size: 12px; }
</style>
<body>
<div align="center"><br><br><h2>Login</h2><br><br>

<div style="margin:10px 0;"></div>
<div title="Login" style="width:400px" id="loginbox">
    <div style="padding:10px 0 10px 60px">
    <form action="login.php" id="login" method="post">
        <table><?php if (isset($err)) echo '<tr><td colspan="2" class="errmsg">'. $err .'</td></tr>'; ?>
            <tr>
                <td>Login:</td>
                <td><input type="text" name="username" style="border: 1px solid #ccc;" autocomplete="off"/></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" style="border: 1px solid #ccc;" autocomplete="off"/></td>
            </tr>
        </table>
        <input class="button" type="submit" name="submit" value="Login" />
    </form>
    </div>
</div>
</div>
</body></html>