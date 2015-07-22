package svin.bowlingliga.Models;


public class Player {
    private int Id;
    private String playerName;
    private int playerRating;
    private int playerWins;
    private int playerLosses;

    public Player(int Id, String PlayerName, int PlayerRating){
        this(Id, PlayerName, PlayerRating,0,0);
    }

    public Player(int Id, String PlayerName, int PlayerRating, int PlayerWins, int PlayerLosses) {
        this.Id = Id;
        this.playerName = PlayerName;
        this.playerWins = PlayerWins;
        this.playerLosses = PlayerLosses;
        this.playerRating = PlayerRating;
    }

    public int getId() { return Id; }

    public String getPlayerName() {
        return playerName;
    }

    public void setPlayerName(String playerName) {
        this.playerName = playerName;
    }

    public int getPlayerWins() {
        return playerWins;
    }

    public void setPlayerWins(int playerWins) {
        this.playerWins = playerWins;
    }

    public int getPlayerLosses() {
        return playerLosses;
    }

    public void setPlayerLosses(int playerLosses) {
        this.playerLosses = playerLosses;
    }

    public int getPlayerRating() {
        return playerRating;
    }

    public void setPlayerRating(int playerRating) {
        this.playerRating = playerRating;
    }
}
