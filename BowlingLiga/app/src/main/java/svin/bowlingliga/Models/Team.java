package svin.bowlingliga.Models;

/**
 * Created by Alexander on 20-07-2015.
 */
public class Team {
    private String teamName;
    private int teamWins;
    private int teamLosses;
    private int teamRating;

    public Team(String teamName, int teamWins, int teamLosses, int teamRating) {
        this.teamName = teamName;
        this.teamWins = teamWins;
        this.teamLosses = teamLosses;
        this.teamRating = teamRating;
    }

    public String getTeamName() {
        return teamName;
    }

    public void setTeamName(String teamName) {
        this.teamName = teamName;
    }

    public int getTeamWins() {
        return teamWins;
    }

    public void setTeamWins(int teamWins) {
        this.teamWins = teamWins;
    }

    public int getTeamLosses() {
        return teamLosses;
    }

    public void setTeamLosses(int teamLosses) {
        this.teamLosses = teamLosses;
    }

    public int getTeamRating() {
        return teamRating;
    }

    public void setTeamRating(int teamRating) {
        this.teamRating = teamRating;
    }
}
