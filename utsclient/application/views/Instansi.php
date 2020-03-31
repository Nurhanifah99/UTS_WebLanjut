<section id="features">
    <div class="container">
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>Nomor Instansi</th>
                    <th>Nama Instansi</th>
                    <th>Alamat</th>
                </tr>
            </thead>

            <tbody>
                <?php
                for ($i = 0; $i < count($instansi['data']); $i++) { ?>
                    <tr>
                        <td> <?= $i + 1 ?></td>
                        <td> <?= $instansi['data'][$i]['nama_instansi'] ?></td>
                        <td> <?= $instansi['data'][$i]['alamat'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>