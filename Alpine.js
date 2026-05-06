app/
├── Http/Controllers/
│   ├── Auth/
│   ├── Admin/
│   │   ├── ExperienceController.php
│   │   ├── ProjectController.php
│   │   ├── BlogSummaryController.php
│   │   ├── ContactController.php
│   │   ├── DesignSettingController.php
│   │   └── TechStackController.php
│   └── Api/
│       ├── ExperienceController.php
│       ├── ProjectController.php
│       ├── BlogSummaryController.php
│       ├── ContactController.php
│       ├── DesignSettingController.php
│       └── TechStackController.php
├── Models/
│   ├── Experience.php
│   ├── Project.php
│   ├── BlogSummary.php
│   ├── Contact.php
│   ├── DesignSetting.php
│   └── TechStack.php
├── Services/
│   ├── PortfolioContentManager.php
│   ├── DesignSettingsManager.php
│   └── TechStackManager.php
└── Http/Requests/
    ├── StoreExperienceRequest.php
    ├── StoreProjectRequest.php
    ├── StoreBlogSummaryRequest.php
    ├── StoreContactRequest.php
    ├── StoreDesignSettingRequest.php
    └── StoreTechStackRequest.php