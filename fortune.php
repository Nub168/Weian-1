<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ហុងស៊ុយ — Phone Fortune</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --amber: #BA7517;
      --amber-light: #FAEEDA;
      --amber-mid: #FAC775;
      --bg: #f7f5f0;
      --surface: #ffffff;
      --fg: #1a1a18;
      --fg2: #6b6a65;
      --border: rgba(0,0,0,0.1);
      --border-em: rgba(0,0,0,0.2);
      --success-bg: #EAF3DE; --success-fg: #3B6D11;
      --danger-bg: #FCEBEB;  --danger-fg: #A32D2D;
      --warn-bg: #FAEEDA;    --warn-fg: #854F0B;
    }

    body {
      font-family: 'DM Mono', monospace;
      background: var(--bg);
      color: var(--fg);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 4rem 1.5rem;
    }

    .card {
      width: 100%;
      max-width: 400px;
    }

    .eyebrow {
      font-size: 10px;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: var(--fg2);
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .eyebrow::after {
      content: '';
      flex: 1;
      height: 0.5px;
      background: var(--border-em);
    }

    h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.1rem;
      font-weight: 600;
      color: var(--fg);
      line-height: 1.15;
      margin-bottom: .4rem;
    }

    .sub {
      font-family: 'Cormorant Garamond', serif;
      font-style: italic;
      font-size: 1rem;
      color: var(--fg2);
      margin-bottom: 2rem;
    }

    .field { position: relative; margin-bottom: .75rem; }

    .field input {
      width: 100%;
      padding: 14px 16px;
      border: 0.5px solid var(--border-em);
      border-radius: 8px;
      background: var(--surface);
      font-family: 'DM Mono', monospace;
      font-size: 1.1rem;
      letter-spacing: .1em;
      color: var(--fg);
      outline: none;
      transition: border-color .2s;
    }
    .field input:focus { border-color: var(--amber); }
    .field input::placeholder { color: var(--fg2); opacity: .5; letter-spacing: .04em; font-size: .85rem; }

    .btn {
      width: 100%;
      padding: 13px;
      background: var(--fg);
      color: var(--surface);
      border: none;
      border-radius: 8px;
      font-family: 'DM Mono', monospace;
      font-size: .75rem;
      letter-spacing: .15em;
      text-transform: uppercase;
      cursor: pointer;
      transition: opacity .2s;
      margin-top: .25rem;
    }
    .btn:hover { opacity: .75; }
    .btn:active { transform: scale(.98); }

    .err {
      font-size: .75rem;
      color: var(--danger-fg);
      margin-bottom: .5rem;
      min-height: 1rem;
    }

    .result {
      margin-top: 2rem;
      border-top: 0.5px solid var(--border-em);
      padding-top: 1.75rem;
      display: none;
      animation: fadeup .4s ease forwards;
    }
    .result.show { display: block; }

    @keyframes fadeup {
      from { opacity: 0; transform: translateY(8px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .score-row {
      display: flex;
      align-items: baseline;
      gap: 12px;
      margin-bottom: 1rem;
    }
    .score-label {
      font-size: 10px;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: var(--fg2);
    }
    .score-num {
      font-family: 'Cormorant Garamond', serif;
      font-size: 3.5rem;
      font-weight: 600;
      color: var(--amber);
      line-height: 1;
    }

    .tag {
      display: inline-block;
      font-size: 10px;
      letter-spacing: .12em;
      text-transform: uppercase;
      padding: 4px 10px;
      border-radius: 100px;
      margin-bottom: .9rem;
    }
    .tag.good { background: var(--success-bg); color: var(--success-fg); }
    .tag.bad  { background: var(--danger-bg);  color: var(--danger-fg); }
    .tag.mid  { background: var(--warn-bg);    color: var(--warn-fg); }

    .meaning {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.05rem;
      line-height: 1.7;
      color: var(--fg);
    }
    .meaning strong { font-weight: 600; }
  </style>
</head>
<body>
  <a href="index.php" style="
  position: fixed;
  top: 1.5rem;
  left: 1.5rem;
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: #6b6a65;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
">
  &larr; Back
</a>
  <div class="card">
    <div class="eyebrow">ហុងស៊ុយ &nbsp; Phone Divination</div>
    <h1>What does your number reveal?</h1>
    <p class="sub">ហុងស៊ុយលេខទូរស័ព្ទ — the fortune within your digits</p>

    <div class="field">
      <input type="tel" id="phone" placeholder="Enter your phone number" maxlength="12" inputmode="numeric">
    </div>
    <div class="err" id="err"></div>
    <button class="btn" id="checkBtn">Reveal Fortune &rarr;</button>

    <div class="result" id="result">
      <div class="score-row">
        <span class="score-label">Your number</span>
        <span class="score-num" id="scoreNum">—</span>
      </div>
      <div class="tag" id="scoreTag"></div>
      <div class="meaning" id="meaning"></div>
    </div>
  </div>

  <script>
    const meanings = {
      1:  ["good","ល្អណាស់","រីកចម្រើនល្អ អាចទទួលបានជ័យជំនះ"],
      2:  ["mid", "ធម្មតា","មានលាភ មានបង់ មិនទទួលផលអ្វី"],
      3:  ["good","ល្អណាស់","មានភាពរីកចម្រើន អ្វីៗអាចសម្រេចបានដូចបំណង"],
      4:  ["bad", "អាក្រក់","ផ្លូវអនាគតមានឧបសគ្គច្រើន លំបាក"],
      5:  ["good","ល្អណាស់","រកសុីមានបាន ទទួលទាំងកិត្តិយស ទាំងផលប្រយោជ"],
      6:  ["good","ល្អណាស់","មានសំណាងច្រើន អាចទទួលបានគុណសម្បត្តិធំ"],
      7:  ["good","ល្អ","ចិត្តអត់ធ្មត់ ពិតជាអាចទទួលបានជោគជ័យ"],
      8:  ["good","ល្អ","អាចមានឳកាសទទួលបានជោគជ័យ"],
      9:  ["bad", "អាក្រក់","ឯកកោ គ្មានអ្នកជួយ ពិបាកទទួលទ្រព្យ"],
      10: ["bad", "អាក្រក់","ខាតបង់ ខិតខំដោយឥតបានផល"],
      11: ["good","ល្អ","មានលំនឹងល្អ អ្នកដទៃសសើរ"],
      12: ["bad", "អាក្រក់","ទន់ខ្សោយ ធ្វើអ្វីក៏មិនបានសម្រេច"],
      13: ["good","ល្អណាស់","មានសំណាងល្អ ក្ដីសង្ឃឹមច្រើន"],
      14: ["mid", "ធម្មតា","ជ័យ ឬ បរាជ័យ ពឹងលើការតាំងចិត្តខ្លួន"],
      15: ["good","ល្អ","ជ័យជំនះច្រើន មានការរីកចម្រើន"],
      16: ["good","ល្អណាស់","អាចសំរេចកិច្ចការធំ ទទួលទាំងកិត្តិយស"],
      17: ["good","ល្អ","មានអ្នកធំជួយ អាចទទួលបានជោគជ័យ"],
      18: ["good","ល្អ","មានភាពរីកចម្រើន នឹងបានសំរេចដូចបំណង"],
      19: ["bad", "អាក្រក់","មានទំនាស់ច្រើន មានឧបសគ្គគ្រប់ជំពូក"],
      20: ["bad", "អាក្រក់","ឧបសគ្គ ឈឺ ពិបាកចិត្ត"],
      21: ["good","ល្អ","ធ្វើការល្អិតល្អន់ មានប្រាជ្ញា"],
      22: ["bad", "អាក្រក់ណាស់","ខាតបង់លាភ ធ្វើអ្វីក៏មិនបានសំរេចដូចបំណង"],
      23: ["good","ល្អណាស់","កិត្តិយសល្អ សំរេចកិច្ចការធំ"],
      24: ["good","ល្អ","ពឹងផ្អែកលើសមត្ថភាពខ្លួន អាចសម្រេចបាន"],
      25: ["good","ល្អណាស់","មានសំណាងល្អ មានគេជួយ"],
      26: ["bad", "អាក្រក់ណាស់","មានឧបសគ្គច្រើន"],
      27: ["good","ល្អ","អាចមានលាភ សំណាង និង ជ័យជំនះ"],
      28: ["good","ល្អណាស់","រាសីឡើងខ្ពស់ រកស៊ីមានបាន"],
      29: ["bad", "អាក្រក់","សំណាងល្អ និង អាក្រក់ កើតឡើងព្រម"],
      30: ["good","ល្អណាស់","ទទួលបានលាភ សំណាង និង កិត្តិយស"],
      31: ["good","ល្អណាស់","មានសំណាង អាចទទួលជោគជ័យ"],
      32: ["good","ល្អ","ប្រាជ្ញាឈ្លាសវៃ មានភាពរីកចម្រើន"],
      33: ["bad", "អាក្រក់ណាស់","ជួបឧបសគ្គ ពិបាកទទួលជោគជ័យ"],
      34: ["mid", "ធម្មតា","ត្រូវមានលំនឹងចិត្ត កុំលោភ"],
      35: ["bad", "អាក្រក់","ឧបសគ្គ ភាពលំបាក ក្រខ្សត់"],
      36: ["good","ល្អ","ឧបសគ្គអាចក្លាយជាសំណាង ធ្វើអ្វីៗបានដូចបំណង"],
      37: ["mid", "ធម្មតា","អាចទទួលកិត្តិយស តែពិបាកទទួលលាភ"],
      38: ["good","ល្អណាស់","អនាគតភ្លឺស្វាង ត្រចះត្រចង់"],
      39: ["mid", "ធម្មតា","សំណាង ឬ ឧបសគ្គ មកមិនទៀង"],
      40: ["good","ល្អណាស់","សំណាងល្អ អនាគតភ្លឺស្វាង"],
      41: ["bad", "អាក្រក់","ការរកស៊ី ត្រូវខាតបង់"],
      42: ["good","ល្អ","ចិត្តអត់ធ្មត់ សំណាងអាក្រក់ ក្លាយជាលាភ"],
      43: ["bad", "អាក្រក់","រឿងអ្វីៗ ពិបាកសម្រេចដូចបំណង"],
      44: ["good","ល្អ","មានសំណាង មានភាពរីកចម្រើន"],
      45: ["good","ល្អណាស់","ជួបឧបសគ្គ ក្លាយជាជំហានឡើង"],
      46: ["good","ល្អណាស់","មានគេជួយថែ អាចប្រកបមុខជំនួញ"],
      47: ["good","ល្អណាស់","មានទាំងកិត្តិយស ទាំងទ្រព្យ"],
      48: ["mid", "ធម្មតា","ឧបសគ្គ ហើយក៏មានសំណាង"],
      49: ["mid", "ធម្មតា","ឧបសគ្គ ហើយក៏មានសំណាង"],
      50: ["mid", "ធម្មតា","លាភ និង ឧបសគ្គ មកមិនទៀង"],
      51: ["good","ល្អ","ខិតខំ នឹងទទួលបានជោគជ័យ"],
      52: ["bad", "អាក្រក់","ពេលបានលាភ ឧបសគ្គតាមមក"],
      53: ["mid", "ធម្មតា","ខិតខំខ្លាំង តែទទួលបានតិចតួច"],
      54: ["bad", "អាក្រក់","ល្អខាងក្រៅ ខ្នងក្នុងមានឧបសគ្គ"],
      55: ["bad", "អាក្រក់ណាស់","ជួបឧបសគ្គ អាចមានគ្រោះថ្នាក់"],
      56: ["good","ល្អ","ខិតខំ អាចកែប្រែជោគវាសនា"],
      57: ["mid", "ធម្មតា","ឧបសគ្គច្រើន សំណាងល្អ នឹងមកក្រោយ"],
      58: ["bad", "អាក្រក់","ចិត្តមិននឹងន ពិបាកសំរេចចិត្ត"],
      59: ["mid", "ធម្មតា","ចិត្តច្របូកច្របល់ ពិបាកសំរេចចិត្ត"],
      60: ["bad", "អាក្រក់","ជួបឧបសគ្គច្រើន"],
      61: ["bad", "អាក្រក់","រឿងស្មុគ ពិបាកសំរេចអ្វីៗ"],
      62: ["good","ល្អ","ពិតប្រាកដ នឹងទទួលបានផលប្រយោជ"],
      63: ["bad", "អាក្រក់","ដឹងច្រើន គ្មានផលប្រយោជ"],
      64: ["good","ល្អ","សំណាងល្អ អាចប្រកបមុខជំនួញធំ"],
      65: ["mid", "ធម្មតា","ល្អ តែខ្វះទំនុកចិត្តលើខ្លួន"],
      66: ["good","ល្អណាស់","ធ្វើអ្វីៗ តែងបានសំរេច មាសប្រាក់ហូរចូល"],
      67: ["good","ល្អ","ក្តាប់ឱកាស អាចទទួលជោគជ័យ"],
      68: ["bad", "អាក្រក់","ស្ថានភាពមិននឹងន ចាញ់បោក ឧបសគ្គ"],
      69: ["bad", "អាក្រក់","រកស៊ីខាត ភ្ញាក់ច្របូកច្របល់"],
      70: ["mid", "ធម្មតា","សំណាង ល្អ ឬ អាក្រក់ អាស្រ័យភាពក្លាហាន"],
      71: ["bad", "អាក្រក់","បានហើយ ប្រែជាបាត់ ពិបាកសំរេចតាមបំណង"],
      72: ["good","ល្អ","មានសុភមង្គល សំណាងល្អ"],
      73: ["mid", "ធម្មតា","បើរុញរា ពិបាកទទួលជោគជ័យ"],
      74: ["mid", "ធម្មតា","សំណាងល្អ ក៏មានអក្រក់ដែរ"],
      75: ["bad", "អាក្រក់","ខាតបង់ឱកាស អស់ទ្រព្យ"],
      76: ["good","ល្អ","ពិបាកមុន ស្រណុកក្រោយ"],
      77: ["mid", "ធម្មតា","មានលាភ មានបង់ មិនអាចស្ដុក"],
      78: ["mid", "ធម្មតា","អនាគតមិនភ្លឺ ហើយក៏មិនមានទ្រព្យ"],
      79: ["bad", "អាក្រក់","ស្ថានភាពប្រែប្រួល ពិបាកកាន់ជ័យ"],
      80: ["good","ល្អណាស់","អាចទទួលបានជោគជ័យច្រើន"]
    };

    function compute(phone) {
      const digits = phone.replace(/\D/g, '');
      if (digits.length < 6) return null;
      const last6 = parseInt(digits.slice(-6));
      const step1 = last6 / 80;
      const decimal = step1 - Math.floor(step1);
      return Math.round(decimal * 80) || 80;
    }

    document.getElementById('checkBtn').addEventListener('click', () => {
      const val = document.getElementById('phone').value.trim();
      const err = document.getElementById('err');
      const res = document.getElementById('result');
      err.textContent = '';
      res.classList.remove('show');

      if (!val) { err.textContent = 'Please enter a phone number.'; return; }
      const digits = val.replace(/\D/g, '');
      if (digits.length < 6) { err.textContent = 'Number must be at least 6 digits.'; return; }

      const score = compute(val);
      if (!score || !meanings[score]) { err.textContent = 'Could not calculate — try again.'; return; }

      const [type, kh, en] = meanings[score];
      document.getElementById('scoreNum').textContent = score;
      const tag = document.getElementById('scoreTag');
      tag.className = 'tag ' + (type === 'good' ? 'good' : type === 'bad' ? 'bad' : 'mid');
      tag.textContent = type === 'good' ? 'Fortunate' : type === 'bad' ? 'Challenging' : 'Neutral';
      document.getElementById('meaning').innerHTML = `<strong>${kh}</strong> — ${en}`;
      res.classList.add('show');
    });

    document.getElementById('phone').addEventListener('keydown', e => {
      if (e.key === 'Enter') document.getElementById('checkBtn').click();
    });
  </script>

</body>
</html>