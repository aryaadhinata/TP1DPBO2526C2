#include <string>
#include <iostream>

using namespace std;

class Penayangan{
    private: // Atribut (data member) dari class Penayangan
        string judulFilm;
        string tanggal;
        string jam;
        string studio;
        int hargaTiket;

    public:
		// Konstruktor default dan konstruktor dengan parameter
        Penayangan(){
            judulFilm = "";
            tanggal = "";
            jam = "";
            studio = "";
            hargaTiket = 0;
        }

		// Konstruktor dengan parameter
        Penayangan(string judulFilmP, string tanggalP, string jamP, string studioP, int hargaTiketP){
            judulFilm = judulFilmP;
            tanggal = tanggalP;
            jam = jamP;
            studio = studioP;
            hargaTiket = hargaTiketP;
        }

		// Setter dan getter untuk setiap atribut
		// Setter untuk judulFilm
        void setJudulFilm(string judulFilmP){
            judulFilm = judulFilmP;
        }

		// Getter untuk judulFilm
        string getJudulFilm(){
            return judulFilm;
        }

		// Setter untuk tanggal
        void setTanggal(string tanggalP){
            tanggal = tanggalP;
        }

		// Getter untuk tanggal
        string getTanggal(){
            return tanggal;
        }

		// Setter untuk jam
        void setJam(string jamP){
            jam = jamP;
        }

		// Getter untuk jam
        string getJam(){
            return jam;
        }

		// Setter untuk studio
        void setStudio(string studioP){
            studio = studioP;
        }

		// Getter untuk studio
        string getStudio(){
            return studio;
        }

		// Setter untuk hargaTiket
        void setHargaTiket(int hargaTiketP){
            hargaTiket = hargaTiketP;
        }

		// Getter untuk hargaTiket
        int getHargaTiket(){
            return hargaTiket;
        }

		// Method untuk menampilkan informasi penayangan
		void tampilkan(){
			cout << "Judul Film  : " << judulFilm << endl;
			cout << "Tanggal     : " << tanggal << endl;
			cout << "Jam         : " << jam << endl;
			cout << "Studio      : " << studio << endl;
			cout << "Harga Tiket : " << hargaTiket << endl;
		}

		// Destructor
        ~Penayangan(){}
};