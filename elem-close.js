const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');
const ws = new WebSocket('ws://127.0.0.1:18800/devtools/page/8D8F27CF51F7B191A6DBA4952FFC7943');
ws.on('open', () => {
  ws.send(JSON.stringify({id:1,method:'Runtime.evaluate',params:{expression:"var btn = document.querySelector('.dialog-close-button') || document.querySelector('.elementor-templates-modal__header__close') || document.querySelector('[aria-label=\"Close\"]'); if(btn){btn.click();console.log('clicked');}else{console.log('not found');}"}}));
});
ws.on('message', (data) => {
  const msg = JSON.parse(data.toString());
  if (msg.id === 1) console.log('Result:', msg.result.result.value);
});
setTimeout(() => ws.close(), 4000);
