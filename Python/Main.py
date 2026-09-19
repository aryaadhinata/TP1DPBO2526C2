from Penayangan import Penayangan

daftar_penayangan = []


# CREATE: menambahkan object baru ke dalam list
def tambah_penayangan():
    print("\n--- Tambah Penayangan Baru ---")
    judul_film = input("Judul Film           : ")
    tanggal = input("Tanggal (YYYY-MM-DD) : ")
    jam = input("Jam (HH:MM)          : ")
    studio = input("Studio               : ")
    harga_tiket = int(input("Harga Tiket          : "))

    # Membuat object Penayangan baru dan menambahkannya ke dalam list
    penayangan_baru = Penayangan(judul_film, tanggal, jam, studio, harga_tiket)
    daftar_penayangan.append(penayangan_baru)

    print(">> Data berhasil ditambahkan!")


# READ: menampilkan seluruh object dalam list
def tampilkan_semua_penayangan():
    print("\n--- Daftar Seluruh Penayangan ---")
    # Mengecek apakah list kosong
    if not daftar_penayangan:
        print("(Belum ada data penayangan)")
        return

    # Menampilkan seluruh penayangan dengan index
    for i, p in enumerate(daftar_penayangan):
        print(f"\n[Index {i}]")
        p.tampilkan()


# UPDATE: mengubah data object pada index tertentu
def update_penayangan():
    tampilkan_semua_penayangan()
    if not daftar_penayangan:
        return

    # Meminta input index dari user
    try:
        index = int(input("\nMasukkan index yang ingin diupdate: "))
    except ValueError:
        print(">> Input tidak valid!")
        return

    if index < 0 or index >= len(daftar_penayangan):
        print(">> Index tidak valid!")
        return

    print(f"\n--- Update Data (index {index}) ---")
    judul_film = input("Judul Film baru  : ")
    tanggal = input("Tanggal baru     : ")
    jam = input("Jam baru         : ")
    studio = input("Studio baru      : ")
    harga_tiket = int(input("Harga Tiket baru : "))

    p = daftar_penayangan[index]
    p.set_judul_film(judul_film)
    p.set_tanggal(tanggal)
    p.set_jam(jam)
    p.set_studio(studio)
    p.set_harga_tiket(harga_tiket)

    print(">> Data berhasil diupdate!")


# DELETE: menghapus object pada index tertentu
def hapus_penayangan():
    tampilkan_semua_penayangan()
    if not daftar_penayangan:
        return

    # Meminta input index dari user
    try:
        index = int(input("\nMasukkan index yang ingin dihapus: "))
    except ValueError:
        print(">> Input tidak valid!")
        return

    if index < 0 or index >= len(daftar_penayangan):
        print(">> Index tidak valid!")
        return

    daftar_penayangan.pop(index)
    print(">> Data berhasil dihapus!")


def main():
    # Data awal (opsional, sebagai contoh)
    daftar_penayangan.append(Penayangan("Avengers: Endgame", "2023-12-01", "19:00", "Studio 1", 50000))
    daftar_penayangan.append(Penayangan("Spider-Man: No Way Home", "2023-12-02", "20:00", "Studio 2", 60000))

    while True:
        print("\n===== MENU PENGELOLAAN PENAYANGAN BIOSKOP =====")
        print("1. Tambah Penayangan (Create)")
        print("2. Tampilkan Semua Penayangan (Read)")
        print("3. Update Penayangan (Update)")
        print("4. Hapus Penayangan (Delete)")
        print("0. Keluar")
        pilihan = input("Pilihan Anda: ")

        if pilihan == "1":
            tambah_penayangan()
        elif pilihan == "2":
            tampilkan_semua_penayangan()
        elif pilihan == "3":
            update_penayangan()
        elif pilihan == "4":
            hapus_penayangan()
        elif pilihan == "0":
            print("Terima kasih, program selesai.")
            break
        else:
            print(">> Pilihan tidak valid, coba lagi.")


if __name__ == "__main__":
    main()