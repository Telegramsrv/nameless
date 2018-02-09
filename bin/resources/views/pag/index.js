"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const messenger_bot_1 = require("@aiteq/messenger-bot");
let bot = new messenger_bot_1.BotServer({
    name: "dearbot",
    port: 4041,
    verifyToken: "efkegkmekgfmks3434354325jidgsksdg",
    accessToken: "EAACEdEose0cBADOJhm9w1H5bTAYCrPw5cdYInKbcfQlayfeBmvhbZCBo8VwTOgjAemN1rgHNvGk3HTgFjZBKCxKITApKuH7yZCZBexxjZAglvXVWiik5XvDtvIqhKDs1EA9hukT3pAkKv5hXOKILMV3D78c3aKvCm5NBaUYjnr7OVl0nzP2yEZCq0NhntH21eCS9mZBfWo7oAZDZD",
    appSecret: "d52b2f62d6f88d725062427173ea77d9"
});
bot.hear("hello", (chat) => {
    chat.say("Hello! I'm Emil, the Bot. How are you?");
});
bot.start();
