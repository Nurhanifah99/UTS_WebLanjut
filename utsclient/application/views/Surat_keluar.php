<section id="features">
    <div class="container">
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>No_surat</th>
                    <th>Tanggal Surat</th>
                    <th>Isi_ringkasan</th>
                    <th>Nomor Instansi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                for ($i = 0; $i < count($surat_keluar); $i++) { ?>
                    <tr>
                        <td> <?= $i + 1 ?></td>
                        <td> <?= $surat_keluar[$i]['tgl_surat'] ?></td>
                        <td> <?= $surat_keluar[$i]['isi_ringkasan'] ?></td>
                        <td> <?= $surat_keluar[$i]['nomor_instansi'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>