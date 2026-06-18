# Hostel Management System — Admin Assignment

Welcome! In this assignment you will extend the hostel management system we have
been building. You already know everything you need: `mysqli`, SQL queries,
`$_SESSION`, `header("Location: ...")` redirects, `if` validations, and Bootstrap.

**Rule:** Do not use anything we have not learned yet. Keep using the same style
you already see in `admin.php`, `login.php`, `processform.php`, etc. (procedural
`mysqli`, plain SQL strings, sessions). No frameworks, no new libraries.

Read every task fully before you start typing.

---

## Overview of what you are building

1. Show **all the users** on the admin page in a proper table (not `print_r`).
2. Add a **gender filter** (show All / Male / Female).
3. Create a **new table** to store hostel allocations (male & female hostel).
4. Let the **admin grant a student access** to a hostel, a **room number**, and a
   **bunk number**.
5. Add **validation rules**:
   - A room can only have **4 bunks** (bunk number must be 1–4, and a room cannot
     hold more than 4 students).
   - The **room number** must be a valid room (1 up to the total number of rooms).
6. **Protect the admin page** — anyone who is not an admin must not be able to
   open `admin.php`.

Do them one at a time, in order. Test after each one.

---

## Step 0 — Prepare your database

We need two new things: a way to know **who is an admin**, the **gender** of each
user, and a **table to store hostel allocations**.

Open phpMyAdmin (http://localhost/phpmyadmin) and run this SQL on the
`hostel_management` database.

### 0a. Add `gender` and `role` columns to the `users` table

```sql
ALTER TABLE users ADD gender VARCHAR(10);
ALTER TABLE users ADD role VARCHAR(10) DEFAULT 'student';
```

- `gender` will store `Male` or `Female`.
- `role` will store `student` or `admin`. New users are `student` by default.

Now make **one** user an admin by hand (use your own email):

```sql
UPDATE users SET role = 'admin' WHERE email = 'youremail@gmail.com';
```

### 0b. Create the hostel allocation table

This single table stores who lives in which hostel, room, and bunk.

```sql
CREATE TABLE hostels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    hostel VARCHAR(10),       -- 'Male' or 'Female'
    room_number INT,
    bunk_number INT
);
```

> Why one table? It keeps things simple. The `hostel` column already tells us if
> it is the male hostel or the female hostel, so we do not need two separate
> tables. (If your teacher asks for two separate tables, you can make
> `male_hostel` and `female_hostel` with the same columns — but start with this.)

---

## Step 1 — Collect gender when a student registers

Right now registration does not ask for gender. Add it.

**In `register.php`:** add a gender select to the form (inside the `<form>`):

```html
<select name="gender">
    <option value="">Select gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
</select> <br><br>
```

**In `processform.php`:** read it and save it.

- Read it near the top, like the other fields:
  ```php
  $gender = $_POST['gender'];
  ```
- Add it to your "all fields are required" check (the `empty(...)` validation).
- Add it to your `INSERT` query so it is saved. Look at your current query:
  ```php
  $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
  ```
  Add the `gender` column and value to it.

✅ **Test:** Register a new user, then check the `users` table in phpMyAdmin — the
gender should be saved.

---

## Step 2 — Protect the admin page (admin-only access)

No one except an admin should see `admin.php`. To do this we need to know the
role of the logged-in user.

### 2a. Save the role in the session when logging in

Open `login.php`. Right now the query only selects `email, password`. Change it
to also get the `role`:

```php
$query = "SELECT email, password, role FROM users WHERE email='$login_email'";
```

After a successful login (inside the `if ($user && password_verify(...))` block),
store the role in the session:

```php
$_SESSION['role'] = $user['role'];
```

### 2b. Block non-admins at the top of `admin.php`

At the **very top** of `admin.php`, before any HTML, add this guard:

```php
<?php
session_start();

// must be logged in AND must be an admin
if (!isset($_SESSION['is_loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php?error=You are not allowed to view that page");
    exit();
}

include "connectdb.php";
```

> `exit();` is important. Without it the rest of the page would still run even
> after the redirect.

✅ **Test:**
- Log in with a normal student → try to open `admin.php` → you should be kicked
  back to the login page.
- Log in with your admin user → `admin.php` should open.

---

## Step 3 — Show all users in a real table

Replace the `print_r($users)` in `admin.php` with a proper Bootstrap table.

You already fetch the users like this:

```php
$query = "SELECT * FROM users";
$resp = mysqli_query($conn, $query);
$users = mysqli_fetch_all($resp, MYSQLI_ASSOC);
```

Now loop through them in the HTML body. Hint — use a `foreach` loop inside the
table:

```php
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['gender'] ?></td>
                <td><?php echo $user['role'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
```

Add the Bootstrap CSS `<link>` in the `<head>` (copy it from `dashboard.php`) so
the table looks nice.

✅ **Test:** Open `admin.php` as admin → you should see all users in a table.

---

## Step 4 — Add a gender filter

Add buttons (or a dropdown) so the admin can show **All**, only **Male**, or only
**Female** users.

**Idea:** use the URL with `$_GET`, the same way `login.php` reads
`$_GET['error']`. The selected gender will travel in the link.

Add filter links above the table:

```php
<a href="admin.php" class="btn btn-secondary">All</a>
<a href="admin.php?gender=Male" class="btn btn-primary">Male</a>
<a href="admin.php?gender=Female" class="btn btn-danger">Female</a>
```

Then, where you build the query, check if a gender was chosen:

```php
$query = "SELECT * FROM users";

if (isset($_GET['gender'])) {
    $gender = $_GET['gender'];
    $query = "SELECT * FROM users WHERE gender='$gender'";
}

$resp = mysqli_query($conn, $query);
$users = mysqli_fetch_all($resp, MYSQLI_ASSOC);
```

✅ **Test:** Click each button — the table should show only that gender, and
"All" should show everyone.

---

## Step 5 — Let the admin allocate a hostel, room, and bunk

This is the main task. The admin picks a student and gives them a hostel (Male or
Female), a room number, and a bunk number.

### 5a. Decide your rules (constants)

At the top of your allocation file, decide how big the hostel is. Use simple
variables:

```php
$total_rooms = 10;     // each hostel has 10 rooms (you choose the number)
$bunks_per_room = 4;   // a room can only have 4 bunks
```

### 5b. Add an allocation form to `admin.php`

In each table row, add a small form (or one form below the table) that sends the
`user_id`, `hostel`, `room_number`, and `bunk_number`. Send it to a new file
`allocate.php` using `method="post"`.

```html
<form action="allocate.php" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
    <select name="hostel">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
    <input name="room_number" type="number" placeholder="Room">
    <input name="bunk_number" type="number" placeholder="Bunk (1-4)">
    <button name="allocate">Allocate</button>
</form>
```

### 5c. Create `allocate.php` and do the validation

This file receives the form, checks the rules, then saves the allocation. Follow
the validation pattern you already use in `processform.php` (check, then
`header("Location: ...")` and `exit()` if something is wrong).

```php
<?php
session_start();

// only an admin can allocate
if (!isset($_SESSION['is_loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php?error=Not allowed");
    exit();
}

include "connectdb.php";

$total_rooms = 10;
$bunks_per_room = 4;

$user_id = $_POST['user_id'];
$hostel = $_POST['hostel'];
$room_number = $_POST['room_number'];
$bunk_number = $_POST['bunk_number'];

// 1. all fields required
if (empty($hostel) || empty($room_number) || empty($bunk_number)) {
    header("Location: admin.php?error=All allocation fields are required");
    exit();
}

// 2. room number must be between 1 and total rooms
if ($room_number < 1 || $room_number > $total_rooms) {
    header("Location: admin.php?error=Room number must be between 1 and $total_rooms");
    exit();
}

// 3. bunk number must be between 1 and 4
if ($bunk_number < 1 || $bunk_number > $bunks_per_room) {
    header("Location: admin.php?error=Bunk number must be between 1 and 4");
    exit();
}

// 4. that exact bunk in that room+hostel must not already be taken
$check_bunk = "SELECT * FROM hostels WHERE hostel='$hostel' AND room_number='$room_number' AND bunk_number='$bunk_number'";
$bunk_resp = mysqli_query($conn, $check_bunk);
if (mysqli_num_rows($bunk_resp) > 0) {
    header("Location: admin.php?error=That bunk is already taken");
    exit();
}

// 5. a room can only hold 4 students (4 bunks)
$count_room = "SELECT * FROM hostels WHERE hostel='$hostel' AND room_number='$room_number'";
$room_resp = mysqli_query($conn, $count_room);
if (mysqli_num_rows($room_resp) >= $bunks_per_room) {
    header("Location: admin.php?error=That room is already full");
    exit();
}

// all good -> save it
$insert = "INSERT INTO hostels (user_id, hostel, room_number, bunk_number) VALUES ('$user_id', '$hostel', '$room_number', '$bunk_number')";
$done = mysqli_query($conn, $insert);

if ($done) {
    header("Location: admin.php?success=Hostel allocated successfully");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
```

### 5d. Show the error / success message on `admin.php`

Near the top of the body in `admin.php`, show any message that came back, the
same way `login.php` shows `$_GET['error']`:

```php
<?php
if (isset($_GET['error'])) {
    echo "<div class='alert alert-warning'>$_GET[error]</div>";
}
if (isset($_GET['success'])) {
    echo "<div class='alert alert-success'>$_GET[success]</div>";
}
?>
```

✅ **Test these cases:**
- Allocate a student to Male hostel, room 1, bunk 1 → success.
- Try room `99` (bigger than `$total_rooms`) → blocked.
- Try bunk `5` → blocked.
- Allocate bunks 1, 2, 3, 4 of the same room, then try to add a 5th student to
  that room → blocked ("room is already full").
- Try to give bunk 1 of a room to two different people → blocked ("bunk already
  taken").

---

## Step 6 (optional, nice to have) — Show each user's allocation

On `admin.php`, you can also show where each user is allocated. In your `foreach`
loop, run a small query per user to read their row from the `hostels` table and
display the hostel/room/bunk in an extra table column. Only attempt this once
everything above works.

---

## Checklist before you submit

- [ ] `gender` and `role` columns added to `users`.
- [ ] `hostels` table created.
- [ ] Registration saves the user's gender.
- [ ] Non-admins are redirected away from `admin.php`.
- [ ] All users show in a Bootstrap table (no more `print_r`).
- [ ] Gender filter (All / Male / Female) works.
- [ ] Admin can allocate hostel + room + bunk.
- [ ] Room number validated (1 to total rooms).
- [ ] Bunk number validated (1 to 4).
- [ ] A room cannot hold more than 4 students.
- [ ] The same bunk cannot be given to two people.

---

## Hints & reminders

- Always put `session_start();` at the **very top** of any page that reads
  `$_SESSION`, before any HTML or spaces.
- After a `header("Location: ...")` redirect, always call `exit();` so the rest of
  the page does not keep running.
- Test after **every** step. Do not write everything and test at the end.
- If a query is not working, temporarily `echo $query;` to see the SQL you built,
  or use `mysqli_error($conn)` to see the database error.
- Keep your code in the same simple style as the rest of the project.
</content>
</invoke>
