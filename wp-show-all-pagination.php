<?php
/*
Plugin Name: Pagination (Show All Style)
Description: Pagination per 400 kata. Nama fungsi show_all_pagination dengan layout baris baru.
Version: 3.5
Author: Nusacloudhost.com
*/

if ( ! defined( 'ABSPATH' ) ) exit;

function show_all_pagination($content) {
    // Jalankan hanya di postingan tunggal dan konten utama
    if (!is_single() || !in_the_loop() || !is_main_query()) return $content;

    // Batas Efisiensi SEO: 400 Kata per Halaman
    $words_per_page = 400; 
    
    // Hitung kata murni
    $pure_text = wp_strip_all_tags($content);
    $word_array = preg_split('/\s+/', $pure_text, -1, PREG_SPLIT_NO_EMPTY);
    $total_words = count($word_array);

    // Jika artikel di bawah 500 kata, tidak perlu dibagi
    if ($total_words <= 500) return $content;

    $total_pages = ceil($total_words / $words_per_page);
    $current_page = isset($_GET['pg']) ? $_GET['pg'] : 1;
    $show_all = ($current_page === 'all');

    if ($show_all) {
        $display_content = $content;
    } else {
        $current_page = max(1, intval($current_page));
        $parts = preg_split('/(\s+)/', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
        
        $word_counter = 0;
        $sliced_content = '';
        $start_at = ($current_page - 1) * $words_per_page;
        $end_at = $start_at + $words_per_page;

        foreach ($parts as $part) {
            if (trim(wp_strip_all_tags($part)) !== '') { $word_counter++; }
            if ($word_counter > $start_at && $word_counter <= $end_at) {
                $sliced_content .= $part;
            }
        }
        // Proteksi tag HTML agar tidak rusak saat dipotong
        $display_content = force_balance_tags($sliced_content);
    }

    // --- Output HTML dengan Layout Baris Baru ---
    $output = '<div id="isolated-article-wrapper" class="entry-content-paged">';
    $output .= $display_content;
    
    $output .= '<div class="media-pagination-container">';
    
    // Baris 1: Label Halaman
    $output .= '<div class="pg-label-row">Halaman :</div>';
    
    // Baris 2: Container Angka & Lihat Semua
    $output .= '<div class="pg-buttons-row">';
    
    // Angka Navigasi
    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($current_page == $i && !$show_all) ? 'is-active' : '';
        $link = add_query_arg('pg', $i, get_permalink());
        $output .= "<a href='{$link}' class='pg-item {$active}'>{$i}</a>";
    }

    // Tombol Lihat Semua (Otomatis ke Kanan)
    $all_active = ($show_all) ? 'is-active' : '';
    $all_link = add_query_arg('pg', 'all', get_permalink());
    $output .= "<a href='{$all_link}' class='pg-item pg-view-all {$all_active}'>Lihat Semua</a>";
    
    $output .= '</div>'; // Tutup pg-buttons-row
    $output .= '</div>'; // Tutup media-pagination-container
    $output .= '</div>'; 

    // CSS Styling Adaptive Font & Theme Color
    $output .= "
    <style>
        #isolated-article-wrapper { 
            clear: both; 
            width: 100%;
            font-family: inherit; 
        }
        .media-pagination-container { 
            margin: 45px 0; 
            padding: 25px 0; 
            border-top: 1px solid rgba(0,0,0,0.08); 
            font-family: inherit;
        }
        .pg-label-row { 
            font-weight: 700; 
            font-size: 15px; 
            color: inherit;
            margin-bottom: 12px; 
            display: block;
            width: 100%;
            font-family: inherit;
        }
        .pg-buttons-row {
            display: flex; 
            align-items: center; 
            gap: 10px; 
            flex-wrap: wrap; 
        }
        .pg-item {
            padding: 6px 14px;
            background: rgba(0,0,0,0.04);
            color: inherit !important;
            text-decoration: none !important;
            border-radius: 4px;
            border: 1px solid rgba(0,0,0,0.1);
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            transition: all 0.2s ease-in-out;
        }
        /* Mendorong Lihat Semua ke Kanan */
        .pg-view-all {
            margin-left: auto;
        }
        /* HOVER & ACTIVE: Warna Tema Otomatis */
        .pg-item:hover, .pg-item.is-active {
            background-color: var(--wp--preset--color--primary, #222) !important;
            color: #ffffff !important;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
        }
        @media (max-width: 480px) {
            .pg-item { padding: 8px 12px; font-size: 13px; }
            .pg-view-all { margin-left: 0; width: 100%; text-align: center; margin-top: 8px; }
        }
    </style>";

    return $output;
}

// Pasang filter dengan nama fungsi baru
add_filter('the_content', 'show_all_pagination', 9999);