package svin.bowlingliga.Models;


import java.util.Date;
import java.util.List;

public class Match {
    public Date date;
    public int homeTeamScore;
    public int awayTeamScore;
    public List<Player> homeTeam;
    public List<Player> awayTeam;

    public Match(Date date, int homeTeamScore, int awayTeamScore, List<Player> homeTeam, List<Player> awayTeam) {
        this.date = date;
        this.homeTeamScore = homeTeamScore;
        this.awayTeamScore = awayTeamScore;
        this.homeTeam = homeTeam;
        this.awayTeam = awayTeam;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public int getHomeTeamScore() {
        return homeTeamScore;
    }

    public void setHomeTeamScore(int homeTeamScore) {
        this.homeTeamScore = homeTeamScore;
    }

    public int getAwayTeamScore() {
        return awayTeamScore;
    }

    public void setAwayTeamScore(int awayTeamScore) {
        this.awayTeamScore = awayTeamScore;
    }

    public List<Player> getHomeTeam() {
        return homeTeam;
    }

    public void setHomeTeam(List<Player> homeTeam) {
        this.homeTeam = homeTeam;
    }

    public List<Player> getAwayTeam() {
        return awayTeam;
    }

    public void setAwayTeam(List<Player> awayTeam) {
        this.awayTeam = awayTeam;
    }
}
