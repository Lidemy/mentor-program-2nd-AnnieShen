
function getData (cb) {
  const clientId = 'tawa4w26htlr3mz4t31mccgz2nbyc0';
  const limit = 20;
  
  $.ajax({
    url: 'https://api.twitch.tv/kraken/streams/?client_id=' + clientId + '&game=League%20of%20Legends&limit=' + limit,
    success: (response) => {
      console.log(response);
      cb(null, response);
    },
    error: (err) => {
      cb(err);
    }
  })
}

getData((err, data) => {
  if (err) {
    console.log(err);
  } else {
    const streams = data.streams;

    const $row = $('.row');
    for(const stream of streams) {
      $row.append(getColumn(stream));
    }  
  }
});


function getColumn(data) {
  return `
    <div class="channel">
	 <a href="${data.channel.url}" target="_blank" class="channel_url">
      <div class="channel_video">
        <img src="${data.preview.medium}"/>
      </div>
	  
      <dl class="channel_info">
          <dt>
              <img src="${data.channel.logo}" />
          </dt><dd>
              ${data.channel.status}
          </dd><dd>
              ${data.channel.display_name}
          </dd>
      </dl>
     </a>
    </div>`;
}