<?php
function tanggal($tanggal)
{
    $bulan = [
        "Januari", "Februari", "Maret",
        "April", "Mei", "Juni", "Juli",
        "Agustus", "September", "Oktober",
        "November", "Desember"
    ];

    $tanggal = explode('-', $tanggal);
    return "{$tanggal[2]} {$bulan[$tanggal[1] - 1]} {$tanggal[0]}";
}

function getBulan($index)
{
    $bulan = [
        "Juli", "Agustus", "September",
        "Oktober", "November", "Desember",
        "Januari", "Februari", "Maret",
        "April", "Mei", "Juni"
    ];

    return $bulan[$index];
}
