#include <iostream>
#include <string>
#include <vector>
#include <limits>
#include "Penayangan.cpp"

using namespace std;

// Membersihkan buffer input agar getline tidak "terlompat"
void bersihkanBuffer() {
    cin.clear();
    cin.ignore(numeric_limits<streamsize>::max(), '\n');
}

// CREATE: menambahkan object baru ke dalam vector
void tambahPenayangan(vector<Penayangan>& daftar) {
    string judulFilm, tanggal, jam, studio;
    int hargaTiket;

    cout << "\n--- Tambah Penayangan Baru ---" << endl;
    cout << "Judul Film             : ";
    getline(cin, judulFilm);
    cout << "Tanggal (YYYY-MM-DD)   : ";
    getline(cin, tanggal);
    cout << "Jam (HH:MM)            : ";
    getline(cin, jam);
    cout << "Studio                 : ";
    getline(cin, studio);
    cout << "Harga Tiket            : ";
    cin >> hargaTiket;
    bersihkanBuffer();

    Penayangan penayanganBaru(judulFilm, tanggal, jam, studio, hargaTiket);
    daftar.push_back(penayanganBaru);

    cout << ">> Data berhasil ditambahkan!" << endl;
}

// READ: menampilkan seluruh object dalam vector
void tampilkanSemuaPenayangan(vector<Penayangan>& daftar) {
    cout << "\n--- Daftar Seluruh Penayangan ---" << endl;
    if (daftar.empty()) {
        cout << "(Belum ada data penayangan)" << endl;
        return;
    }
    for (int i = 0; i < daftar.size(); i++) {
        cout << "\n[Index " << i << "]" << endl;
        daftar[i].tampilkan();
    }
}

// UPDATE: mengubah data object pada index tertentu
void updatePenayangan(vector<Penayangan>& daftar) {
    tampilkanSemuaPenayangan(daftar);
    if (daftar.empty()) return;

    int index;
    cout << "\nMasukkan index yang ingin diupdate: ";
    cin >> index;
    bersihkanBuffer();

    if (index < 0 || index >= (int)daftar.size()) {
        cout << ">> Index tidak valid!" << endl;
        return;
    }

    string judulFilm, tanggal, jam, studio;
    int hargaTiket;

    cout << "\n--- Update Data (index " << index << ") ---" << endl;
    cout << "Judul Film baru  : ";
    getline(cin, judulFilm);
    cout << "Tanggal baru     : ";
    getline(cin, tanggal);
    cout << "Jam baru         : ";
    getline(cin, jam);
    cout << "Studio baru      : ";
    getline(cin, studio);
    cout << "Harga Tiket baru : ";
    cin >> hargaTiket;
    bersihkanBuffer();

    daftar[index].setJudulFilm(judulFilm);
    daftar[index].setTanggal(tanggal);
    daftar[index].setJam(jam);
    daftar[index].setStudio(studio);
    daftar[index].setHargaTiket(hargaTiket);

    cout << ">> Data berhasil diupdate!" << endl;
}

// DELETE: menghapus object pada index tertentu
void hapusPenayangan(vector<Penayangan>& daftar) {
    tampilkanSemuaPenayangan(daftar);
    if (daftar.empty()) return;

    int index;
    cout << "\nMasukkan index yang ingin dihapus: ";
    cin >> index;
    bersihkanBuffer();

    if (index < 0 || index >= (int)daftar.size()) {
        cout << ">> Index tidak valid!" << endl;
        return;
    }

    daftar.erase(daftar.begin() + index);
    cout << ">> Data berhasil dihapus!" << endl;
}

int main() {
    vector<Penayangan> daftarPenayangan;

    // Data awal (opsional, sebagai contoh)
    daftarPenayangan.push_back(Penayangan("Avengers: Doomsday", "2026-12-01", "19:00", "Studio 1", 50000));
    daftarPenayangan.push_back(Penayangan("Spider-Man: Brand New Day", "2026-08-25", "20:00", "Studio 2", 60000));

    int pilihan;
    do {
        cout << "\n===== MENU PENGELOLAAN PENAYANGAN BIOSKOP =====" << endl;
        cout << "1. Tambah Penayangan (Create)" << endl;
        cout << "2. Tampilkan Semua Penayangan (Read)" << endl;
        cout << "3. Update Penayangan (Update)" << endl;
        cout << "4. Hapus Penayangan (Delete)" << endl;
        cout << "0. Keluar" << endl;
        cout << "Pilihan Anda: ";
        cin >> pilihan;
        bersihkanBuffer();

        switch (pilihan) {
            case 1:
                tambahPenayangan(daftarPenayangan);
                break;
            case 2:
                tampilkanSemuaPenayangan(daftarPenayangan);
                break;
            case 3:
                updatePenayangan(daftarPenayangan);
                break;
            case 4:
                hapusPenayangan(daftarPenayangan);
                break;
            case 0:
                cout << "Terima kasih, program selesai." << endl;
                break;
            default:
                cout << ">> Pilihan tidak valid, coba lagi." << endl;
        }
    } while (pilihan != 0);

    return 0;
}