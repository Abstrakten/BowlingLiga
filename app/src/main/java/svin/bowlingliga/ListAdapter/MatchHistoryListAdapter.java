package svin.bowlingliga.ListAdapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.text.SimpleDateFormat;
import java.util.List;
import java.util.Locale;

import svin.bowlingliga.Models.Match;
import svin.bowlingliga.Models.Player;
import svin.bowlingliga.R;

// Custom list adapter for the list of causes in order to implement a custom-made setup for each item
public class MatchHistoryListAdapter extends BaseAdapter
{
    private LayoutInflater mInflater;
    private List<Match> matchList;

    public MatchHistoryListAdapter(Context context, List<Match> matches)
    {
        mInflater = LayoutInflater.from(context);
        matchList = matches;
    }

    @Override
    public int getCount()
    {
        return matchList.size();
    }

    @Override
    public Object getItem(int position)
    {
        return matchList.get(position);
    }

    @Override
    public long getItemId(int position)
    {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent)
    {
        View view;
        ViewHolder holder;
        if(convertView == null)
        {
            view = mInflater.inflate(R.layout.match_history_list_item, parent, false);
            holder = new ViewHolder();
            holder.homePlayerOne = (TextView)view.findViewById(R.id.firstPlayerName);
            holder.homePlayerTwo = (TextView)view.findViewById(R.id.secondPlayerName);
            holder.awayPlayerOne = (TextView)view.findViewById(R.id.thirdPlayerName);
            holder.awayPlayerTwo = (TextView)view.findViewById(R.id.fourthPlayerName);
            holder.homeTeamScore = (TextView)view.findViewById(R.id.LeftTeamScore);
            holder.awayTeamScore = (TextView)view.findViewById(R.id.RightTeamScore);
            holder.date = (TextView)view.findViewById(R.id.matchDate);
            view.setTag(holder);
        } else
        {
            view = convertView;
            holder = (ViewHolder)view.getTag();
        }

        SimpleDateFormat formatter = new SimpleDateFormat("dd. MMM");
        Match match = matchList.get(position);

        holder.homePlayerOne.setText(match.getHomeTeam().get(0).getPlayerName());
        holder.homePlayerTwo.setText(match.getHomeTeam().get(1).getPlayerName());
        holder.awayPlayerOne.setText(match.getAwayTeam().get(0).getPlayerName());
        holder.awayPlayerTwo.setText(match.getAwayTeam().get(1).getPlayerName());
        holder.homeTeamScore.setText(String.valueOf(match.getHomeTeamScore()));
        holder.awayTeamScore.setText(String.valueOf(match.getAwayTeamScore()));
        holder.date.setText(formatter.format(match.getDate()));




        return view;
    }

    private class ViewHolder
    {
        public TextView date;
        public TextView homePlayerOne,homePlayerTwo, homeTeamScore;
        public TextView awayPlayerOne,awayPlayerTwo, awayTeamScore;
    }
}

