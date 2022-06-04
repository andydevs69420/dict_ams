

<?php

return [                                  # =========== ACCESSLEVEL ===========
    "PROVINCIAL_OFFICER"          => 4  , # Provincial Officer
    "FOCAL"                       => 5  , # Focal
    "BUDGET_OFFICER"              => 11 , # Budget Officer
    "CHIEF_TOD"                   => 12 , # Chief TOD
    "STAFF"                       => 13 , # Staff
    "ADMIN"                       => 14 , # Admin
    # ============================== GROUP ==============================
    "VALID_REQUISITIONER"         => [4, 5, 13] , # Provincial Officer, Focal and Staff
    "VALID_RECOMMENDING_APPROVAL" => [4, 12]    , # Provincial Officer and Chief TOD
];

