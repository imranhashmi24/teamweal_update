<?php

namespace App\Constants;

class Status{

    const ENABLE = 1;
    const DISABLE = 0;

    const ACTIVE = 1;
    const INACTIVE = 0;

    const YES = 1;
    const NO = 0;

    const VERIFIED = 1;
    const UNVERIFIED = 0;

    const PAYMENT_INITIATE = 0;
    const PAYMENT_SUCCESS = 1;
    const PAYMENT_PENDING = 2;
    const PAYMENT_REJECT = 3;

    CONST TICKET_OPEN = 0;
    CONST TICKET_ANSWER = 1;
    CONST TICKET_REPLY = 2;
    CONST TICKET_CLOSE = 3;

    CONST PRIORITY_LOW = 1;
    CONST PRIORITY_MEDIUM = 2;
    CONST PRIORITY_HIGH = 3;

    const USER_ACTIVE = 1;
    const USER_BAN = 0;


    const PENDING = 0;
    const APPROVED = 1;
    const REVIEW = 1;
    const ACCEPT = 1;
    const REJECT = 2;
    const PUBLISHED = 3;

    const CURRENT = 1;
    const UPCOMING = 2;
    const FINISHED = 3;


    const CONTINUE = 1;

    const COMPLETED = 2;
}
