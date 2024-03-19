import './bootstrap';
import * as Dashboard from "./dashboard.js";

$(document).ready(async function () {
    console.log('OK');
    Dashboard.createDataTable()
    await Dashboard.updateTotalCash()
})
