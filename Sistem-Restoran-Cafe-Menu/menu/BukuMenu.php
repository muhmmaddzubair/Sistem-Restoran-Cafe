
<?php
session_start();

if (!isset($_SESSION["pesanan"])) {
    $_SESSION["pesanan"] = [];
}

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["pesan"])) {
        $menu = htmlspecialchars(trim($_POST["nama_item"] ?? ""));
        $catatan = htmlspecialchars(trim($_POST["catatan"] ?? ""));

        if ($catatan == "") {
            $catatan = "tidak ada catatan";
        }

        $_SESSION["pesanan"][] = [
            "menu" => $menu,
            "catatan" => $catatan
        ];

        $pesan = "Pesanan berhasil ditambahkan!";
    }

    if (isset($_POST["edit"])) {
        $id = (int) $_POST["id"];

        if (isset($_SESSION["pesanan"][$id])) {
            $_SESSION["edit_id"] = $id;
        }
    }

    if (isset($_POST["simpan_edit"])) {
        $id = (int) $_POST["id"];

        $menu = htmlspecialchars(trim($_POST["nama_item"] ?? ""));
        $catatan = htmlspecialchars(trim($_POST["catatan"] ?? ""));

        if ($catatan == "") {
            $catatan = "tidak ada catatan";
        }

        if (isset($_SESSION["pesanan"][$id]) && $menu != "") {
            $_SESSION["pesanan"][$id]["menu"] = $menu;
            $_SESSION["pesanan"][$id]["catatan"] = $catatan;

            $pesan = "Pesanan berhasil diedit!";
        }

        unset($_SESSION["edit_id"]);
    }

    if (isset($_POST["batal_edit"])) {
        unset($_SESSION["edit_id"]);
    }

    if (isset($_POST["delete"])) {
        $id = (int) $_POST["id"];

        if (isset($_SESSION["pesanan"][$id])) {
            unset($_SESSION["pesanan"][$id]);
            $_SESSION["pesanan"] = array_values($_SESSION["pesanan"]);

            unset($_SESSION["edit_id"]);

            $pesan = "Pesanan berhasil dihapus!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Menu Cafe</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #000;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .alert-box {
            border: 1px solid #000;
            padding: 10px 15px;
            margin-bottom: 20px;
            min-height: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        th {
            background-color: #000;
            color: #fff;
            text-align: left;
            padding: 12px;
            font-size: 14px;
        }

        td {
            border: 1px solid #e0e0e0;
            padding: 15px 12px;
            vertical-align: middle;
            font-size: 14px;
        }

        .fw-bold {
            font-weight: bold;
        }

        input[type="text"] {
            width: 90%;
            padding: 6px;
            border: 1px solid #ccc;
            font-size: 13px;
            margin-bottom: 8px;
        }

        button {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 6px 16px;
            cursor: pointer;
            font-size: 13px;
            margin: 2px;
        }

        button:hover {
            background-color: #333;
        }

        .delete {
            background-color: #c62828;
        }

        .delete:hover {
            background-color: #a00000;
        }
    </style>
</head>

<body>

<h1>Buku Menu Cafe</h1>
<div class="subtitle">Menu cafe yang berisi makanan & minuman</div>

<div class="alert-box">
    <?php if ($pesan != ""): ?>
        <strong><?php echo $pesan; ?></strong>
    <?php endif; ?>
</div>

<table>
    <thead>
        <tr>
            <th>Kategori</th>
            <th>Nama Item</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Halal</th>
            <th>Alergen</th>
            <th>Catatan Pesanan</th>
        </tr>
    </thead>

    <tbody>

        <?php
        $menuCafe = [
            ["Coffee", "Cafe Latte", "Espresso dengan campuran susu steamed yang lembut", "Rp25.000", "Ya", "Susu"],
            ["Matcha", "Matcha Latte", "Matcha dengan campuran susu steamed yang lembut", "Rp30.000", "Ya", "Susu"],
            ["Makanan", "Donat", "Kue donat kentang yang lembut dan manis", "Rp10.000", "Ya", "Makanan"],
            ["Coffee", "Cappuccino", "Espresso dengan susu steamed dan foam susu", "Rp25.000", "Ya", "Susu"]
        ];

        foreach ($menuCafe as $menu):
        ?>

        <tr>
            <td class="fw-bold"><?php echo $menu[0]; ?></td>
            <td class="fw-bold"><?php echo $menu[1]; ?></td>
            <td><?php echo $menu[2]; ?></td>
            <td class="fw-bold"><?php echo $menu[3]; ?></td>
            <td><?php echo $menu[4]; ?></td>
            <td><?php echo $menu[5]; ?></td>

            <td>
                <form method="POST">
                    <input type="hidden" name="nama_item" value="<?php echo $menu[1]; ?>">

                    <input type="text" name="catatan" placeholder="Contoh: less sugar">

                    <br>

                    <button type="submit" name="pesan">Pesan</button>
                </form>
            </td>
        </tr>

        <?php endforeach; ?>

    </tbody>
</table>

<br>

<h2>Daftar Pesanan</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Menu</th>
            <th>Catatan</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        <?php if (count($_SESSION["pesanan"]) > 0): ?>

            <?php foreach ($_SESSION["pesanan"] as $id => $item): ?>

            <tr>
                <td><?php echo $id + 1; ?></td>

                <?php if (isset($_SESSION["edit_id"]) && $_SESSION["edit_id"] == $id): ?>

                    <td colspan="3">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <input type="text" name="nama_item"
                                value="<?php echo $item["menu"]; ?>" required>

                            <input type="text" name="catatan"
                                value="<?php echo $item["catatan"]; ?>">

                            <br>

                            <button type="submit" name="simpan_edit">
                                Simpan
                            </button>

                            <button type="submit" name="batal_edit">
                                Batal
                            </button>
                        </form>
                    </td>

                <?php else: ?>

                    <td><?php echo $item["menu"]; ?></td>

                    <td><?php echo $item["catatan"]; ?></td>

                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <button type="submit" name="edit">
                                Edit
                            </button>

                            <button type="submit" name="delete"
                                class="delete"
                                onclick="return confirm('Yakin ingin menghapus pesanan ini?')">
                                Delete
                            </button>
                        </form>
                    </td>

                <?php endif; ?>

            </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="4" style="text-align:center;">
                    Belum ada pesanan
                </td>
            </tr>

        <?php endif; ?>

    </tbody>
</table>

</body>
</html>
