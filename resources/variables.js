var report_header={
          TITLE:         'CCC PLC REPORTS',
      SUBTITLE:         '*****NO SUB TITLE*****',
      EXTRA_TITLE:         '*****NO SUB TITLE*****',
      HEADER_DATA:{},
      
      BRANCHER:         {
          
                       00100: 'BAMENDA',
                       00200: 'BATIBO',
                       00300: 'WARDA',
                       00400: 'REPUBLIQUE',
                       00500: 'BUEA',
                       00600: 'KUMBA',
                       00700: 'LIBERTE',
                       00800: 'BONABERI',
                       00900: 'TIKO',
                       01000: 'SAPHIR',
                       01100: 'ACROPOLE',   
                       01200: 'BAFOUSSAM',
                       01300: 'HEAD OFFICE',
                       01400: 'KRIBI',
                       01500: 'MUYUKA',
                       01600: 'LIMBE',
                       01700: 'BIYEMASSI',
                       01800: 'NDOGPASSI',
                       01900: 'BAMBILI',
      
                      },
       BRANCH_ZEROLESS:         {
          
                       100: 'BAMENDA',
                       200: 'BATIBO',
                       300: 'WARDA',
                       400: 'REPUBLIQUE',
                       500: 'BUEA',
                       600: 'KUMBA',
                       700: 'LIBERTE',
                       800: 'BONABERI',
                       900: 'TIKO',
                       1000: 'SAPHIR',
                       1100: 'ACROPOLE',   
                       1200: 'BAFOUSSAM',
                       1300: 'HEAD OFFICE',
                       1400: 'KRIBI',
                       1500: 'MUYUKA',
                       1600: 'LIMBE',
                       1700: 'BIYEMASSI',
                       1800: 'NDOGPASSI',
                       1900: 'BAMBILI',
                       999:'TOTAL',
          
                      },
}

var header_body={
   
    
}

var signature_footer={
    
    SIGNATURE: 'SIGNATURES',
    SIGNATORY_ONE: 'JOHN DOE',
    SIGNATORY_TWO: 'JOHN DOE',
    SIGNATORY_THREE: 'JOHN DOE',
    SIGNATORY_FOUR: 'JOHN DOE',
    
}

var report_footer={
  FOOTER_DATA :{}, 
}


var report_CONF={
    HEADER:{ 
    START: 0,
    STOP: 7,
    HEIGHT_LABEL_ONE_INFO:80,
    WIDTH_LABEL_ONE_INFO:200,
    PAGE_ORIENTATION:'P',
    HEIGHT_LABEL_TWO:80,
    HEIGHT_LABEL_ONE:80,
    WIDTH_LABEL_TWO:350,
    WIDTH_LABEL_ONE:70,
    HEIGHT_LABEL_TWO_INFO:80,
    WIDTH_LABEL_TWO_INFO:480,    
    TITLE_WIDTH:250,    
    SUB_TITLE_WIDTH:250,    
    SUB_TITLE_HEIGHT:60, 
    EXTRA_TITLE_WIDTH:250,    
    EXTRA_TITLE_HEIGHT:80, 
    TITLE_HEIGHT:40,  
    SUB_TITLE_SIZE:11,
    EXTRA_TITLE_SIZE:10,
    TITLE_SIZE:14,
    EXPORT_NAME:'ccc_plc_report'
           },
    
    FOOTER:{  
    START: 7,
    STOP: 14,
    HEIGHT_LABEL_ONE:80,
    WIDTH_LABEL_ONE:70,
    HEIGHT_LABEL_ONE_INFO:80,
    WIDTH_LABEL_ONE_INFO:200,
    HEIGHT_LABEL_TWO:80,
    WIDTH_LABEL_TWO:350,
    HEIGHT_LABEL_TWO_INFO:80,
    WIDTH_LABEL_TWO_INFO:480,
    FOOTER_SIZE:5,
    },
    
    
}


// this is used to specify reports for the amotization table
var definer = {
      BRANCH: '00000',
      NAME_OF_BENEFICIARY:        'JOHN DOE',
      ID_CARD_NO:           '000000000',
      CONTACT_ADDRESS:    'WORLD ST 0000',
      AMOUNT_GRANTED:         '00000000',
      DURATION_OF_LOAN:   '00 MONTHS',       // true = speed up export of large tables with hidden cells (hidden cells will be exported !)
      LOAN_PERIOD_FROM:            '00-00-0000',
      TO_:            '00-00-0000',
      EFFECTIVE_DATE_OF_LOAN:            '00-00-0000',
      ACCOUNT:         '3700000000-00',
      LOAN_CODE:         '000000',
      EMERGENCY:         'Y/N',
      INTEREST_RATE:         '00%',
      EMERGENCY:         'Y/N',
      CLIENT:         '000000',
      TOTAL_LOAN:         '000 000 000',
      TOTAL_INTEREST:         '000 000 000',
      LOAN_APPLICATION_FEE:         '000 000 000',
      HANDLING_CHARGES:         '000 000 000',
      TOTAL_VAT:         '000 000 000',
      GRAND_TOTAL:         '000 000 000',   
}


