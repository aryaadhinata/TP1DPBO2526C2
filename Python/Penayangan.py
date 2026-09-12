class Penayangan:
    # Constructor
    def __init__(self, judul_film="", tanggal="", jam="", studio="", harga_tiket=0):
        self.judul_film = judul_film
        self.tanggal = tanggal
        self.jam = jam
        self.studio = studio
        self.harga_tiket = harga_tiket

    # Getter & Setter
    def get_judul_film(self):
        return self.judul_film

    def set_judul_film(self, judul_film):
        self.judul_film = judul_film

    def get_tanggal(self):
        return self.tanggal

    def set_tanggal(self, tanggal):
        self.tanggal = tanggal

    def get_jam(self):
        return self.jam

    def set_jam(self, jam):
        self.jam = jam

    def get_studio(self):
        return self.studio

    def set_studio(self, studio):
        self.studio = studio

    def get_harga_tiket(self):
        return self.harga_tiket

    def set_harga_tiket(self, harga_tiket):
        self.harga_tiket = harga_tiket

    def tampilkan(self):
        print(f"Judul Film  : {self.judul_film}")
        print(f"Tanggal     : {self.tanggal}")
        print(f"Jam         : {self.jam}")
        print(f"Studio      : {self.studio}")
        print(f"Harga Tiket : {self.harga_tiket}")