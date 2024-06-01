const {app, BrowserWindow, ipcMain} = require('electron');
const {PosPrinter} = require('electron-pos-printer');

let win;

app.on('ready', () => {
    win = new BrowserWindow({
        width: 650,
        height: 450,
        webPreferences: {
            nodeIntegration: true
        }
    });

    win.loadFile('/cashere/views/kasir/print-note.php');
    win.webContents.openDevTools();
});

ipcMain.on('print', (event, arg) => {
    const data = JSON.parse(arg);
    PosPrinter.print(data, {
        printerName: 'EPSON-L3110',
        silent: true,
        preview: true
    }).catch(error => console.error(error));
});