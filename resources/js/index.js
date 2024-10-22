import { addEventListenerInBtnAlterMenu } from "./sidebar.js";
import { addEventListenerInBtnAlterMenuMobile } from "./header.js";

window.onload = () => {
    addEventListenerInBtnAlterMenu();
    addEventListenerInBtnAlterMenuMobile();
};
