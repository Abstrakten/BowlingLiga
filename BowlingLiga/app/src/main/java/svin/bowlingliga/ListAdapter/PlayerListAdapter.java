package svin.bowlingliga.ListAdapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.List;

import svin.bowlingliga.Models.Player;
import svin.bowlingliga.R;

// Custom list adapter for the list of causes in order to implement a custom-made setup for each item
public class PlayerListAdapter extends BaseAdapter
{
    private LayoutInflater mInflater;
    private List<Player> playerList;

    public PlayerListAdapter(Context context, List<Player> players)
    {
        mInflater = LayoutInflater.from(context);
        playerList = players;
    }

    @Override
    public int getCount()
    {
        return playerList.size();
    }

    @Override
    public Object getItem(int position)
    {
        return playerList.get(position);
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
            view = mInflater.inflate(R.layout.team_list_item, parent, false);
            holder = new ViewHolder();
            holder.teamName = (TextView)view.findViewById(R.id.playerName);
            holder.teamWins = (TextView)view.findViewById(R.id.playerWins);
            holder.teamLosses = (TextView)view.findViewById(R.id.playerLosses);
            holder.teamRating = (TextView)view.findViewById(R.id.playerRating);
            view.setTag(holder);
        } else
        {
            view = convertView;
            holder = (ViewHolder)view.getTag();
        }

        Player player = playerList.get(position);

        holder.teamName.setText(player.getPlayerName());
        holder.teamWins.setText(String.valueOf(player.getPlayerWins()));
        holder.teamLosses.setText(String.valueOf(player.getPlayerLosses()));
        holder.teamRating.setText(String.valueOf(player.getPlayerRating()));


        return view;
    }

    private class ViewHolder
    {
        public TextView teamName, teamWins, teamLosses, teamRating;
    }
}

