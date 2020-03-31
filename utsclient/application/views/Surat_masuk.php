<section id="features">
    <div class="container">
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>Kode_surat</th>
                    <th>Nomor_instansi</th>
                    <th>No_agenda</th>
                    <th>Isi_ringkasan</th>
                    <th>No_surat</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Diterima</th>
                    <th>Penerima</th>
                </tr>
            </thead>

            <tbody>
                <?php
                for ($i = 0; $i < count($surat_masuk); $i++) { ?>
                    <tr>
                        <td> <?= $i + 1 ?></td>
                        <td> <?= $surat_masuk[$i]['nomor_instansi'] ?></td>
                        <td> <?= $surat_masuk[$i]['no_agenda'] ?></td>
                        <td> <?= $surat_masuk[$i]['isi_ringkasan'] ?></td>
                        <td> <?= $surat_masuk[$i]['no_surat'] ?></td>
                        <td> <?= $surat_masuk[$i]['tgl_surat'] ?></td>
                        <td> <?= $surat_masuk[$i]['tgl_diterima'] ?></td>
                        <td> <?= $surat_masuk[$i]['penerima'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>