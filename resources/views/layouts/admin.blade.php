<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard - The Nusantara')</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f2ee;
            color: #e4dcd1;
            margin: 0;
        }

        .sidebar {
            width: 220px;
            min-height: 100vh;
            background-color: #462611;
            border-right: 1px solid rgba(228, 220, 209, 0.1);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px 20px 18px;
            border-bottom: 1px solid rgba(228, 220, 209, 0.1);
        }

        .sidebar-brand .brand-name {
            font-size: 18px;
            font-weight: 700;
            color: #c8a97e;
            letter-spacing: 0.5px;
            display: block;
        }

        .sidebar-brand .brand-sub {
            font-size: 12px;
            color: #a08060;
            letter-spacing: 2px;
            text-transform: uppercase;
            display: block;
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 12px 0;
            overflow-y: auto;
        }

        .nav-label {
            font-size: 9px;
            color: #a08060;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 12px 20px 4px;
            display: block;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            color: #c8a97e;
            text-decoration: none;
            font-size: 15px;
            font-weight: 400;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }

        .nav-item i {
            font-size: 18px;
            flex-shrink: 0;
        }

        .nav-item:hover {
            color: #fff;
            background-color: rgba(200, 169, 126, 0.1);
            border-left-color: rgba(200, 169, 126, 0.3);
        }

        .nav-item.active {
            color: #c8a97e;
            background-color: rgba(200, 169, 126, 0.15);
            border-left-color: #c8a97e;
            font-weight: 600;
        }

        .sidebar-bottom {
            padding: 12px 0;
            border-top: 1px solid rgba(228, 220, 209, 0.1);
        }

        .nav-item.logout {
            color: #a08060;
        }

        .nav-item.logout:hover {
            color: #f09595;
            background-color: rgba(226, 75, 74, 0.08);
            border-left-color: #f09595;
        }

        .main-content {
            margin-left: 150px;
            margin-top: 0px;
            padding: 22px 16px;
            height: 100%;
            width: calc(100% - 190px);
            box-sizing: border-box;
            overflow-x: hidden;
        }

        h1 {
            color: #462611;
            font-size: 30px;
        }

        .page-sub {
            font-size: 16px;
            color: #999;
            margin-top: 4px;
            font-weight: 400;
            margin-bottom: 40px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 30px;
            align-items: start;
            max-width: 100%;
        }

        .left-col {
            display: flex;
            flex-direction: column;
            gap: 30px;
            min-width: 0;
            height: 100%;
        }

        .right-col {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            min-width: 0;
        }

        .stat-card {
            background-color: #f5f5f5;
            border: 1px solid rgba(228, 220, 209, 0.08);
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 16px;
            min-height: 140px;
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: rgba(200, 169, 126, 0.25);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background-color: rgba(70, 38, 17, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon i {
            font-size: 16px;
            color: #462611;
        }

        .stat-label {
            font-size: 11px;
            color: #462611;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #462611;
            line-height: 1;
            margin-bottom: 10px;
            display: block;
        }

        .stat-badge {
            font-size: 14px;
            padding: 3px 8px;
            border-radius: 6px;
            display: inline-block;
            font-weight: 600;
        }

        .badge-up {
            background-color: rgba(99, 153, 34, 0.12);
            color: #58290d9d;
        }

        .badge-down {
            background-color: rgba(226, 75, 74, 0.12);
            color: #e63a3a;
        }

        .badge-neutral {
            background-color: rgba(200, 169, 126, 0.12);
            color: #c8a97e;
        }

        .chart-card {
            background-color: #f5f5f5;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            max-width: 100%;
            overflow: hidden;
            flex: 1;
        }

        #visitorChart {
            height: 450px !important;
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .chart-header h3 {
            font-size: 14px;
            font-weight: 600;
            color: #462611;
            margin: 0;
        }

        .chart-sub {
            font-size: 11px;
            color: #999;
        }

        .pulau-card {
            background-color: #f5f5f5;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .pulau-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .pulau-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: #462611;
            margin: 0;
        }

        .pulau-header span {
            font-size: 16px;
            color: #58290d;
        }

        .pulau-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(70, 38, 17, 0.06);
        }

        .pulau-item:last-child {
            border-bottom: none;
        }

        .pulau-rank {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background-color: rgba(70, 38, 17, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: #462611;
            flex-shrink: 0;
        }

        .pulau-rank.top {
            background-color: #462611;
            color: #fff;
        }

        .pulau-info {
            flex: 1;
        }

        .pulau-nama {
            font-size: 14px;
            font-weight: 600;
            color: #462611;
            display: block;
        }

        .pulau-lokasi {
            font-size: 12px;
            color: #58290d;
            display: block;
            margin-top: 1px;
        }

        .pulau-bar-wrap {
            width: 80px;
        }

        .pulau-bar-bg {
            background-color: rgba(70, 38, 17, 0.08);
            border-radius: 4px;
            height: 6px;
            overflow: hidden;
        }

        .pulau-bar {
            height: 6px;
            border-radius: 4px;
            background-color: #462611;
        }

        .pulau-views {
            font-size: 12px;
            color: #58290d;
            text-align: right;
            margin-top: 3px;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0px;
            gap: 20px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        /* Notifikasi */
        .topbar-notif {
            position: relative;
            width: 55px;
            height: 55px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            color: #58290d;
            font-size: 16px;
        }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #e74c3c;
            color: white;
            font-size: 10px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notif-dropdown {
            display: none;
            position: absolute;
            top: 52px;
            right: 0;
            width: 300px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            z-index: 999;
            overflow: hidden;
        }

        .notif-dropdown.show {
            display: block;
        }

        .notif-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 16px;
            font-weight: 700;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
        }

        .notif-header small {
            color: #e74c3c;
            font-weight: 600;
        }

        .notif-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-bottom: 1px solid #f9f9f9;
            transition: background 0.2s;
        }

        .notif-item:hover {
            background: #fdf8f4;
        }

        .notif-item.unread {
            background: #fef9f0;
        }

        .notif-icon-wrap {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
            color: white;
        }

        .notif-icon-wrap.blue {
            background: #3498db;
        }

        .notif-icon-wrap.green {
            background: #2ecc71;
        }

        .notif-icon-wrap.orange {
            background: #e67e22;
        }

        .notif-icon-wrap.gray {
            background: #95a5a6;
        }

        .notif-text p {
            font-size: 13px;
            font-weight: 500;
            color: #333;
            margin: 0;
        }

        .notif-text small {
            font-size: 11px;
            color: #999;
        }

        .notif-footer {
            text-align: center;
            padding: 12px;
            font-size: 12px;
            color: #58290d;
            font-weight: 600;
            cursor: pointer;
        }

        .notif-footer:hover {
            background: #fdf8f4;
        }

        /* Profil */
        .topbar-profile {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            border-radius: 50px;
            padding: 6px 14px 6px 6px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .profile-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #58290d;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }

        .profile-name {
            font-size: 13px;
            font-weight: 700;
            color: #2c1a0e;
            display: block;
            line-height: 1.2;
        }

        .profile-role {
            font-size: 11px;
            color: #999;
            display: block;
        }

        .profile-chevron {
            font-size: 11px;
            color: #999;
            margin-left: 4px;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            top: 52px;
            right: 0;
            width: 240px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            z-index: 999;
            overflow: hidden;
        }

        .profile-dropdown.show {
            display: block;
        }

        .profile-dropdown-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: #fdf8f4;
        }

        .profile-avatar-lg {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #58290d;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .profile-dropdown-name {
            font-size: 14px;
            font-weight: 700;
            color: #2c1a0e;
            margin: 0;
        }

        .profile-dropdown-email {
            font-size: 11px;
            color: #999;
            margin: 0;
        }

        .profile-dropdown-divider {
            height: 1px;
            background: #f0f0f0;
        }

        .profile-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            font-size: 13px;
            color: #444;
            transition: background 0.2s;
            text-decoration: none;
        }

        .profile-dropdown-item:hover {
            background: #fdf8f4;
            color: #58290d;
        }

        .profile-dropdown-item.danger {
            color: #e74c3c;
        }

        .profile-dropdown-item.danger:hover {
            background: #fef0f0;
        }

        .profile-dropdown-item i {
            width: 16px;
        }

        /* ===== CATATAN ===== */
        .note-card {
            background-color: #f5f5f5;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 14px;
            padding: 16px;
            height: 373px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
        }

        .note-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .note-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: #462611;
            margin: 0;
        }

        .note-card textarea {
            width: 100%;
            height: 150px;
            border: 1px solid rgba(70, 38, 17, 0.15);
            border-radius: 10px;
            padding: 10px 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #462611;
            background-color: #fefefe;
            resize: none;
            outline: none;
            transition: border-color 0.2s;
        }

        .note-card textarea:focus {
            border-color: #8b5a2b;
        }

        .note-save-btn {
            width: 100%;
            margin-top: 8px;
            padding: 8px;
            background-color: #462611;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .note-save-btn:hover {
            background-color: #5c3318;
        }

        .note-list {
            margin-top: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 102px;
            overflow-y: auto;
        }

        .note-item {
            background-color: #fefefe;
            border: 1px solid rgba(70, 38, 17, 0.1);
            border-radius: 10px;
            padding: 10px 12px;
            position: relative;
        }

        .note-item-isi {
            font-size: 14px;
            color: #462611;
            line-height: 1.5;
            margin-bottom: 4px;
            word-break: break-word;
            padding-right: 20px;
        }

        .note-item-waktu {
            font-size: 12px;
            color: #999;
        }

        .note-item-hapus {
            position: absolute;
            top: 8px;
            right: 8px;
            background: none;
            border: none;
            color: #ccc;
            cursor: pointer;
            font-size: 16px;
            transition: color 0.2s;
        }

        .note-item-hapus:hover {
            color: #e63a3a;
        }

        .note-list::-webkit-scrollbar {
            width: 4px;
        }

        .note-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .note-list::-webkit-scrollbar-thumb {
            background-color: rgba(70, 38, 17, 0.2);
            border-radius: 4px;
        }

        /* ===== KELOLA INFORMASI ===== */

        .ki-btn-tambah {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #462611;
            color: #fff;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            padding: 9px 18px;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: background 0.2s;
        }

        .ki-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .ki-search-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .ki-search-icon {
            position: absolute;
            left: 12px;
            color: #999;
            font-size: 16px;
        }

        .ki-search-input {
            padding: 9px 14px 9px 34px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            width: 250px;
            height: 50px;
            outline: none;
            transition: border-color 0.3s;
        }

        .ki-search-input:focus {
            border-color: #7b4f2e;
        }

        .ki-btn-tambah:hover {
            background: #5c3318;
            color: #fff;
        }

        .ki-toolbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ki-select {
            padding: 9px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 13px;
            outline: none;
            cursor: pointer;
            transition: border-color 0.3s;
            font-family: "Poppins", sans-serif;
        }

        .ki-select:focus {
            border-color: #7b4f2e;
        }

        .ki-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .ki-page-info {
            font-size: 13px;
            color: #888;
        }

        .ki-page-btns {
            display: flex;
            gap: 6px;
        }

        .ki-page-btn {
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 13px;
            color: #462611;
            background: white;
            text-decoration: none;
            transition: all 0.2s;
        }

        .ki-page-btn:hover {
            background: #f0e6cc;
            border-color: #7b4f2e;
        }

        .ki-page-btn.active {
            background: #462611;
            color: white;
            border-color: #462611;
        }

        /* ===== FORM CARD ===== */
        .ki-form-card {
            background: #f5f5f5;
            border-radius: 14px;
            padding: 20px 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .ki-form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .ki-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .ki-form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .ki-form-group label {
            font-size: 12px;
            font-weight: 600;
            color: #462611;
        }

        .ki-form-group input,
        .ki-form-group textarea,
        .ki-form-group select {
            border: 1px solid rgba(70, 38, 17, 0.2);
            border-radius: 10px;
            padding: 9px 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color: #462611;
            background: #fff;
            outline: none;
            transition: border-color 0.2s;
        }

        .ki-form-group input:focus,
        .ki-form-group textarea:focus,
        .ki-form-group select:focus {
            border-color: #8b5a2b;
        }

        .ki-form-group select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24'%3E%3Cpath fill='%23462611' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-color: #fff;
            padding-right: 32px;
        }

        .ki-form-actions {
            display: flex;
            gap: 10px;
        }

        .ki-btn-add {
            background: #462611;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
        }

        .ki-btn-add:hover {
            background: #5c3318;
        }

        .ki-btn-cancel {
            background: rgba(70, 38, 17, 0.08);
            color: #462611;
            border: none;
            border-radius: 10px;
            padding: 9px 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
        }

        .ki-btn-cancel:hover {
            background: rgba(70, 38, 17, 0.15);
        }

        .ki-table-card {
            background: #f5f5f5;
            border-radius: 14px;
            overflow-x: auto;
            overflow-y: auto;
            max-height: 645px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-top: 30px;
        }

        .ki-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .ki-table thead tr {
            background: #462611;
        }

        .ki-table th {
            text-align: center;
            padding: 13px 14px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            letter-spacing: 0.3px;
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 2;
            background: #462611;
        }

        .ki-table tbody tr {
            background: #fff;
            border-bottom: 1px solid rgba(70, 38, 17, 0.07);
            transition: background 0.15s;
        }

        .ki-table tbody tr:hover {
            background: rgba(70, 38, 17, 0.03);
        }

        .ki-table td {
            padding: 12px 14px;
            color: #462611;
            vertical-align: middle;
            text-align: center;
        }

        .td-isi {
            max-width: 220px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: left;
        }

        /* Badge pulau */
        .ki-badge {
            display: inline-block;
            background: rgba(70, 38, 17, 0.08);
            color: #462611;
            font-size: 14px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* Thumbnail gambar */
        .ki-thumb {
            width: 90px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid rgba(70, 38, 17, 0.1);
        }

        .ki-no-img {
            color: #bbb;
        }

        /* Tombol aksi */
        .ki-aksi {
            display: flex;
            justify-content: center;
            gap: 6px;
        }

        .ki-btn-hapus {
            background: rgba(226, 75, 74, 0.1);
            color: #e63a3a;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: background 0.2s;
        }

        .ki-btn-edit {
            background: rgba(226, 75, 74, 0.1);
            color: #3a3de6;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: background 0.2s;
        }

        .ki-btn-edit:hover {
            background: #3a3de627;
        }

        .ki-btn-hapus:hover {
            background: rgba(226, 75, 74, 0.2);
        }

        /* Kosong */
        .ki-empty {
            text-align: center;
            color: #bbb;
            padding: 40px;
            font-size: 13px;
            line-height: 2;
        }

        .ki-empty i {
            font-size: 28px;
            color: #ddd;
        }

        .ki-btn-proses {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #fff8e6;
            color: #1a3a7a;
            border: 0.5px solid #f5d88a;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }

        .ki-btn-selesai {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #e6f5ec;
            color: #1a7a3f;
            border: 0.5px solid #a3d9b5;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }

        .status-pending {
            background: #fff8e6;
            color: #b37a00;
            padding: 3px 10px;
            border-radius: 10px;
            font-size: 15px;
        }

        .status-proses {
            background: #e6eaf5;
            color: #1a3a7a;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 15px;
        }

        .user-avatar-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f5ede6;
            color: #3d1f0d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 500;
            flex-shrink: 0;
        }

        .ki-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .ki-modal-overlay.active {
            display: flex;
        }

        .ki-modal {
            background: #fff;
            border-radius: 16px;
            padding: 36px;
            max-width: 700px;
            width: 92%;
            max-height: 88vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.25);
        }

        .ki-modal-close {
            position: absolute;
            top: 16px;
            right: 18px;
            background: none;
            border: none;
            font-size: 22px;
            cursor: pointer;
            color: #999;
            line-height: 1;
            transition: color 0.2s;
        }

        .ki-modal-close:hover {
            color: #333;
        }

        .ki-modal-title {
            font-size: 22px;
            font-weight: 700;
            color: #3d1b08;
            margin-bottom: 4px;
        }

        .ki-modal-pulau {
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #c8922a;
            font-weight: 700;
            margin-bottom: 16px;
            display: block;
        }

        .ki-modal-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
            display: block;
        }

        .ki-modal-section {
            margin-bottom: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid #f0e8dc;
        }

        .ki-modal-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .ki-modal-section-label {
            font-size: 10px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            font-weight: 700;
            color: #58290D;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ki-modal-section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f0e8dc;
        }

        .ki-modal-section p {
            font-size: 14px;
            line-height: 1.75;
            color: #4a2a10;
            white-space: pre-line;
        }

        .ki-modal-extra-imgs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .ki-modal-extra-imgs img {
            height: 100px;
            flex: 1;
            min-width: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .ki-modal-extra-cap {
            font-size: 11px;
            color: #9c7355;
            text-align: center;
            margin-top: 4px;
        }

        .ki-btn-detail {
            background: rgba(26, 107, 60, 0.1);
            color: #1a6b3c;
            border: none;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 15px;
            font-family: inherit;
            transition: background 0.2s;
        }

        .ki-btn-detail:hover {
            background: rgba(74, 209, 130, 0.35);
        }

        .ki-alert {
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .ki-alert-success {
            background: #e6f5ec;
            color: #1a7a3f;
            border: 1px solid #a3d9b5;
        }

        .lap-status {
            font-size: 15px;
        }
    </style>
    @stack('styles')
</head>

<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <span class="brand-name">The Nusantara</span>
        <span class="brand-sub">Admin Panel</span>
    </div>
    <nav class="sidebar-nav">
        <span class="nav-label">Menu</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('admin.tentang.index') }}" class="nav-item {{ request()->routeIs('admin.tentang.*') ? 'active' : '' }}">
            Tentang
        </a>
        <a href="{{ route('admin.pulau.index') }}" class="nav-item {{ request()->routeIs('admin.pulau.*') ? 'active' : '' }}">
            Pulau
        </a>
        <a href="{{ route('admin.informasi.index') }}" class="nav-item {{ request()->routeIs('admin.informasi.*') ? 'active' : '' }}">
            Kelola Informasi
        </a>
        <a href="{{ route('admin.galeri.index') }}" class="nav-item {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
            Galeri
        </a>
        <a href="{{ route('admin.faq.index') }}" class="nav-item {{ request()->routeIs('admin.faq.*') ? 'active' : '' }}">
            FAQ
        </a>
        <a href="{{ route('admin.laporan.index') }}" class="nav-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
            Laporan
        </a>
    </nav>
    <div class="sidebar-bottom">
        <a href="{{ route('logout') }}" class="nav-item logout">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
    </div>
</div>

<div class="main-content">
    @yield('content')
</div>

<div>
</div>
<script>
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;

    function simpanCatatan() {
        const isi = document.getElementById('catatan');
        if (!isi || !isi.value.trim()) return;
        fetch("{{ route('admin.catatan') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=simpan&isi=' + encodeURIComponent(isi.value.trim()) + '&_token=' + encodeURIComponent(CSRF_TOKEN)
        })
        .then(res => res.json())
        .then(data => {
            if (data.status == 'ok') {
                isi.value = '';
                loadCatatan();
            }
        });
    }

    function hapusCatatan(id) {
        fetch("{{ route('admin.catatan') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=hapus&id=' + id + '&_token=' + encodeURIComponent(CSRF_TOKEN)
        })
        .then(res => res.json())
        .then(data => {
            if (data.status == 'ok') loadCatatan();
        });
    }

    function loadCatatan() {
        const list = document.getElementById('noteList');
        if (!list) return;
        fetch("{{ route('admin.catatan') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=ambil&_token=' + encodeURIComponent(CSRF_TOKEN)
        })
        .then(res => res.json())
        .then(data => {
            if (data.length === 0) {
                list.innerHTML = '<p style="font-size:11px;color:#ccc;text-align:center;padding:10px 0;">Belum ada catatan</p>';
                return;
            }
            list.innerHTML = data.map(item => `
                <div class="note-item">
                    <div class="note-item-isi">${item.isi}</div>
                    <div class="note-item-waktu">${item.dibuat}</div>
                    <button class="note-item-hapus" onclick="hapusCatatan(${item.id})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `).join('');
        })
        .catch(() => {
            list.innerHTML = '<p style="font-size:11px;color:#ccc;text-align:center;padding:10px 0;">Gagal memuat catatan</p>';
        });
    }

    window.onload = function () {
        if (document.getElementById('noteList')) {
            loadCatatan();
        }
    }
</script>
@stack('scripts')
</body>
</html>
