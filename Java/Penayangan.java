public class Penayangan { 
    // Atribut-atribut untuk menyimpan informasi penayangan
    private String judulFilm;
    private String tanggal;
    private String jam;
    private String studio;
    private int hargaTiket;

    // Konstruktor default
    public Penayangan() {
        this.judulFilm = "";
        this.tanggal = "";
        this.jam = "";
        this.studio = "";
        this.hargaTiket = 0;
    }

    // Konstruktor dengan parameter
    public Penayangan(String judulFilm, String tanggal, String jam, String studio, int hargaTiket) {
        this.judulFilm = judulFilm;
        this.tanggal = tanggal;
        this.jam = jam;
        this.studio = studio;
        this.hargaTiket = hargaTiket;
    }

    // Getter & Setter
    public String getJudulFilm() {
        return judulFilm;
    }

    public void setJudulFilm(String judulFilm) {
        this.judulFilm = judulFilm;
    }

    public String getTanggal() {
        return tanggal;
    }

    public void setTanggal(String tanggal) {
        this.tanggal = tanggal;
    }

    public String getJam() {
        return jam;
    }

    public void setJam(String jam) {
        this.jam = jam;
    }

    public String getStudio() {
        return studio;
    }

    public void setStudio(String studio) {
        this.studio = studio;
    }

    public int getHargaTiket() {
        return hargaTiket;
    }

    public void setHargaTiket(int hargaTiket) {
        this.hargaTiket = hargaTiket;
    }

    public void tampilkan() {
        System.out.println("Judul Film            : " + judulFilm);
        System.out.println("Tanggal (YYYY-MM-DD)  : " + tanggal);
        System.out.println("Jam (HH:MM)           : " + jam);
        System.out.println("Studio                : " + studio);
        System.out.println("Harga Tiket           : " + hargaTiket);
    }
}