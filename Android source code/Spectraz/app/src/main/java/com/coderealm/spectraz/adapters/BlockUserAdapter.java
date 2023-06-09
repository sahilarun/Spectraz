package com.coderealm.spectraz.adapters;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RelativeLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.facebook.drawee.view.SimpleDraweeView;
import com.coderealm.spectraz.interfaces.AdapterClickListener;
import com.coderealm.spectraz.models.FollowingModel;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.simpleclasses.Functions;

import java.util.ArrayList;

public class BlockUserAdapter extends RecyclerView.Adapter<BlockUserAdapter.ViewHolder> {

    private ArrayList<FollowingModel> list;
    private AdapterClickListener click;

    public BlockUserAdapter(ArrayList<FollowingModel> list, AdapterClickListener click) {
        this.list = list;
        this.click = click;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_block_user, parent,false);
        return new ViewHolder(v);
    }


    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        FollowingModel model = list.get(position);

        holder.tvUserName.setText(model.username);
        holder.ivProfileImg.setController(Functions.frescoImageLoad(model.profile_pic,R.drawable.image_placeholder,holder.ivProfileImg,false));

        holder.bind(position, model, click);
    }



    @Override
    public int getItemCount() {
        return list.size();
    }




    class ViewHolder extends RecyclerView.ViewHolder {

        TextView tvUserName;
        SimpleDraweeView ivProfileImg;
        RelativeLayout tabBlock,mainLayout;

        ViewHolder(@NonNull View itemView) {
            super(itemView);
            tvUserName = itemView.findViewById(R.id.tvUserName);
            ivProfileImg=itemView.findViewById(R.id.ivProfile);
            tabBlock =itemView.findViewById(R.id.block_layout);
            mainLayout=itemView.findViewById(R.id.mainLayout);
        }


        public void bind(final int pos, final Object model, final AdapterClickListener listener) {

            tabBlock.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    listener.onItemClick(v,pos,model);
                }

            });
            mainLayout.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    listener.onItemClick(v,pos,model);
                }

            });

        }

    }
}
