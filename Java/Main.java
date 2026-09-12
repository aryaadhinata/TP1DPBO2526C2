import java.util.ArrayList;
import java.util.Scanner;

public class Main {
    static Scanner scanner = new Scanner(System.in);
    static ArrayList<Penayangan> daftarPenayangan = new ArrayList<>();

    public static void main(String[] args) {
        // data dummy untuk mempermudah pengujian
        daftarPenayangan.add(new Penayangan("Avengers: Doomsday", "2026-12-01", "19:00", "Studio 1", 50000));
        daftarPenayangan.add(new Penayangan("Spider-Man: Brand New Day", "2026-08-25", "20:00", "Studio 2", 60000));
        int pilihan; // variabel untuk menyimpan pilihan menu
        // Looping menu utama
        do {
            // Menampilkan menu utama
            System.out.println("\n===== MENU PENGELOLAAN PENAYANGAN BIOSKOP =====");
            System.out.println("1. Tambah Penayangan (Create)");
            System.out.println("2. Tampilkan Semua Penayangan (Read)");
            System.out.println("3. Update Penayangan (Update)");
            System.out.println("4. Hapus Penayangan (Delete)");
            System.out.println("0. Keluar");
            System.out.print("Pilihan Anda: ");

            // Membaca input pilihan dari user
            pilihan = Integer.parseInt(scanner.nextLine().trim());

            // Menangani pilihan menu menggunakan switch-case
            switch (pilihan) {
                case 1:
                    tambahPenayangan();
                    break;
                case 2:
                    tampilkanSemuaPenayangan();
                    break;
                case 3:
                    updatePenayangan();
                    break;
                case 4:
                    hapusPenayangan();
                    break;
                case 0:
                    System.out.println("Terima kasih, program selesai.");
                    break;
                default:
                    System.out.println(">> Pilihan tidak valid, coba lagi.");
            }
        } while (pilihan != 0);

        // Menutup scanner sebelum program berakhir
        scanner.close();
    }

    // CREATE: menambahkan object baru ke dalam ArrayList
    static void tambahPenayangan() {
        System.out.println("\n--- Tambah Penayangan Baru ---");

        System.out.print("Judul Film            : ");
        String judulFilm = scanner.nextLine();

        System.out.print("Tanggal (YYYY-MM-DD)  : ");
        String tanggal = scanner.nextLine();

        System.out.print("Jam (HH:MM)           : ");
        String jam = scanner.nextLine();

        System.out.print("Studio                : ");
        String studio = scanner.nextLine();

        System.out.print("Harga Tiket           : ");
        int hargaTiket = Integer.parseInt(scanner.nextLine().trim());

        Penayangan penayanganBaru = new Penayangan(judulFilm, tanggal, jam, studio, hargaTiket);
        daftarPenayangan.add(penayanganBaru);

        System.out.println(">> Data berhasil ditambahkan!");
    }

    // READ: menampilkan seluruh object dalam ArrayList
    static void tampilkanSemuaPenayangan() {
        System.out.println("\n--- Daftar Seluruh Penayangan ---");
        if (daftarPenayangan.isEmpty()) {
            System.out.println("(Belum ada data penayangan)");
            return;
        }
        for (int i = 0; i < daftarPenayangan.size(); i++) {
            System.out.println("\n[Index " + i + "]");
            daftarPenayangan.get(i).tampilkan();
        }
    }

    // UPDATE: mengubah data object pada index tertentu
    static void updatePenayangan() {
        tampilkanSemuaPenayangan();
        if (daftarPenayangan.isEmpty()) return;

        System.out.print("\nMasukkan index yang ingin diupdate: ");
        int index = Integer.parseInt(scanner.nextLine().trim());

        if (index < 0 || index >= daftarPenayangan.size()) {
            System.out.println(">> Index tidak valid!");
            return;
        }

        System.out.println("\n--- Update Data (index " + index + ") ---");

        System.out.print("Judul Film baru  : ");
        String judulFilm = scanner.nextLine();

        System.out.print("Tanggal baru     : ");
        String tanggal = scanner.nextLine();

        System.out.print("Jam baru         : ");
        String jam = scanner.nextLine();

        System.out.print("Studio baru      : ");
        String studio = scanner.nextLine();

        System.out.print("Harga Tiket baru : ");
        int hargaTiket = Integer.parseInt(scanner.nextLine().trim());

        Penayangan p = daftarPenayangan.get(index);
        p.setJudulFilm(judulFilm);
        p.setTanggal(tanggal);
        p.setJam(jam);
        p.setStudio(studio);
        p.setHargaTiket(hargaTiket);

        System.out.println(">> Data berhasil diupdate!");
    }

    // DELETE: menghapus object pada index tertentu
    static void hapusPenayangan() {
        tampilkanSemuaPenayangan();
        if (daftarPenayangan.isEmpty()) return;

        System.out.print("\nMasukkan index yang ingin dihapus: ");
        int index = Integer.parseInt(scanner.nextLine().trim());

        if (index < 0 || index >= daftarPenayangan.size()) {
            System.out.println(">> Index tidak valid!");
            return;
        }

        daftarPenayangan.remove(index);
        System.out.println(">> Data berhasil dihapus!");
    }
}