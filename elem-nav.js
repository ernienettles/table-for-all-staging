const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');
const ws = new WebSocket('ws://127.0.0.1:18800/devtools/page/8D8F27CF51F7B191A6DBA4952FFC7943');
ws.on('open', () => {
  ws.send(JSON.stringify({id:1,method:'Page.navigate',params:{url:'https://ernien.sg-host.com/wp-admin/post.php?post=42506&action=elementor'}}));
});
ws.on('message', (data) => {
  const msg = JSON.parse(data.toString());
  if (msg.id === 1) console.log('nav ok');
});
setTimeout(() => ws.close(), 3000);
