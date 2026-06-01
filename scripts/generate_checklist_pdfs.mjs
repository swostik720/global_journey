import fs from 'node:fs';
import path from 'node:path';
import PDFDocument from 'pdfkit';

const projectRoot = process.cwd();
const outputDir = path.join(projectRoot, 'public', 'frontend', 'assets', 'pdf');
const preferredLogoPath = path.join(
  projectRoot,
  'public',
  'uploaded-images',
  'site-setting-images',
  'RXun1DXkrTYfSHzNi71vu9CU7FtEfdJAruk1Nbdm.png'
);
const fallbackLogoPath = path.join(projectRoot, 'public', 'frontend', 'assets', 'img', 'logo.png');
const logoPath = fs.existsSync(preferredLogoPath) ? preferredLogoPath : fallbackLogoPath;
const datasetPath = path.join(projectRoot, 'database', 'seeders', 'data', 'document_checklists.json');

if (!fs.existsSync(datasetPath)) {
  throw new Error(`Shared checklist dataset not found at ${datasetPath}`);
}

const dataset = JSON.parse(fs.readFileSync(datasetPath, 'utf8'));
const commonNotes = Array.isArray(dataset.common_notes) ? dataset.common_notes : [];
const countries = Array.isArray(dataset.countries) ? dataset.countries : [];

function safeText(value) {
  return String(value ?? '').replace(/\u001b\[[0-9;]*m/g, '').replace(/\s+/g, ' ').trim();
}

function slugBullet(text) {
  return `• ${safeText(text)}`;
}

function hasSpace(doc, minHeight) {
  const bottomLimit = doc.page.height - doc.page.margins.bottom - 22;
  return doc.y + minHeight <= bottomLimit;
}

function addPage(doc) {
  doc.addPage({ size: 'A4', margins: { top: 34, right: 40, bottom: 44, left: 40 } });
  doc.y = 34;
}

function drawHeader(doc, countryName, subtitle, isFirstPage) {
  const left = doc.page.margins.left;
  const top = 28;
  const width = doc.page.width - doc.page.margins.left - doc.page.margins.right;
  const height = isFirstPage ? 88 : 68;

  doc.save();
  doc.roundedRect(left, top, width, height, 16).fill(isFirstPage ? '#F1F7FF' : '#F7FAFD');
  doc.roundedRect(left, top, width, height, 16).lineWidth(1).stroke('#D7E6F3');
  doc.restore();

  if (fs.existsSync(logoPath)) {
    doc.image(logoPath, left + 14, top + 10, { width: isFirstPage ? 112 : 88 });
  }

  doc
    .font('Helvetica-Bold')
    .fillColor('#0D4B78')
    .fontSize(isFirstPage ? 18 : 14)
    .text(`${countryName} Student Document Checklist`, left + (isFirstPage ? 138 : 112), top + 12, {
      width: width - (isFirstPage ? 150 : 126),
      lineGap: 1.5,
    });

  if (isFirstPage) {
    doc
      .font('Helvetica')
      .fillColor('#35566F')
      .fontSize(10.5)
      .text(subtitle, left + 138, top + 38, { width: width - 160, lineGap: 2 });

    doc
      .font('Helvetica-Bold')
      .fillColor('#1C6AA0')
      .fontSize(9)
      .text('Global Journey Education', left + 138, top + 66);

    doc
      .font('Helvetica')
      .fillColor('#5B6E7E')
      .fontSize(8.5)
      .text('Updated: June 2026', left + width - 130, top + 68, { width: 120, align: 'right' });
  }

    doc.y = top + height + 12;
}

function drawPanel(doc, title, accentColor, textColor, heightHint = 22) {
  const width = doc.page.width - doc.page.margins.left - doc.page.margins.right;
  const left = doc.page.margins.left;

  doc.save();
  doc.roundedRect(left, doc.y, width, heightHint, 12).fill(accentColor);
  doc.restore();

  doc
    .font('Helvetica-Bold')
    .fillColor(textColor)
    .fontSize(11.3)
    .text(title, left + 12, doc.y + 6, { width: width - 24 });
}

function drawBullets(doc, bullets) {
  const left = doc.page.margins.left + 14;
  const width = doc.page.width - doc.page.margins.left - doc.page.margins.right - 28;

  bullets.forEach((bullet) => {
    const bulletText = slugBullet(bullet);
    doc
      .font('Helvetica')
      .fillColor('#334155')
      .fontSize(10.2)
      .text(bulletText, left, doc.y, { width, lineGap: 2 });
    doc.moveDown(0.15);
  });
}

function drawCard(doc, card, layout) {
  const { x, y, width, height, badgeText = '', compact = false } = layout;
  const badgeNumber = Number.parseInt(String(badgeText), 10);
  const accent = card.accent ?? (Number.isFinite(badgeNumber) && badgeNumber % 2 === 0 ? '#F7FBF9' : '#EAF3FF');
  const titleColor = card.titleColor ?? '#123D5A';
  const badgeColor = card.badgeColor ?? '#146092';
  const title = safeText(card.title);
  const lines = Array.isArray(card.lines) ? card.lines : [];
  const bodyFontSize = compact ? 8.9 : 9.4;
  const titleFontSize = compact ? 10.8 : 11.4;
  const hasBadge = String(badgeText).trim().length > 0;
  const titleX = hasBadge ? x + 82 : x + 26;
  const titleWidth = hasBadge ? width - 104 : width - 52;

  doc.save();
  doc.roundedRect(x, y, width, height, 14).fill('#FFFFFF');
  doc.roundedRect(x, y, width, height, 14).lineWidth(1).stroke('#D9E7F0');
  doc.restore();

  if (hasBadge) {
    doc.save();
    doc.roundedRect(x + 18, y + 18, 40, 32, 12).fill(accent);
    doc.restore();

    doc
      .font('Helvetica-Bold')
      .fillColor(badgeColor)
      .fontSize(10.8)
      .text(badgeText, x + 18, y + 28, { width: 40, align: 'center' });
  }

  doc
    .font('Helvetica-Bold')
    .fillColor(titleColor)
    .fontSize(titleFontSize)
    .text(title, titleX, y + 22, {
      width: titleWidth,
      height: compact ? 26 : 30,
      ellipsis: true,
      lineGap: 1.2,
    });

  const bodyText = lines.map((line) => slugBullet(line)).join('\n');
  doc
    .font('Helvetica')
    .fillColor('#334155')
    .fontSize(bodyFontSize)
    .text(bodyText, x + 22, y + 66, {
      width: width - 44,
      height: height - 84,
      ellipsis: true,
      lineGap: 1.35,
    });
}

function drawStackedCards(doc, cards, layout) {
  const { startY, cardWidth, cardHeight, gapY, indexOffset = 0 } = layout;
  cards.forEach((card, index) => {
    const x = doc.page.margins.left;
    const y = startY + index * (cardHeight + gapY);
    drawCard(doc, card, {
      x,
      y,
      width: cardWidth,
      height: cardHeight,
      badgeText: card.hideBadge ? '' : String(indexOffset + index + 1).padStart(2, '0'),
      compact: true,
    });
  });
}

function buildCountryPdf(countryName, config) {
  const outPath = path.join(outputDir, config.filename);
  const doc = new PDFDocument({
    size: 'A4',
    margins: { top: 30, right: 26, bottom: 30, left: 26 },
    info: {
      Title: `${countryName} Student Document Checklist`,
      Author: 'Global Journey Education',
      Subject: 'International Student Documentation',
      Keywords: 'student visa, checklist, global journey, admissions',
    },
  });

  fs.mkdirSync(outputDir, { recursive: true });
  const outputStream = fs.createWriteStream(outPath);
  const finished = new Promise((resolve, reject) => {
    outputStream.on('finish', resolve);
    outputStream.on('error', reject);
    doc.on('error', reject);
  });

  doc.pipe(outputStream);

  const sectionCards = config.sections.map((section, index) => ({
    title: safeText(section.title).replace(/^\d+[.)]\s*/u, ''),
    lines: Array.isArray(section.bullets) ? section.bullets : [],
  }));

  const qualityCard = {
    title: 'General Quality Rules',
    lines: Array.isArray(commonNotes) ? commonNotes : [],
    accent: '#EAF7F0',
    titleColor: '#215C47',
    badgeColor: '#215C47',
  };

  const finalCard = {
    title: 'Final Verification Before Submission',
    lines: [
      'Review all files for consistency of names, dates, amounts, and signatures.',
      'Keep originals available for interview and maintain a secure backup archive.',
    ],
    accent: '#FDF1DD',
    titleColor: '#8A5B12',
    badgeColor: '#8A5B12',
    hideBadge: true,
  };

  drawHeader(doc, countryName, config.subtitle, true);
  doc
    .font('Helvetica')
    .fillColor('#334155')
    .fontSize(10.1)
    .text(config.summary, doc.page.margins.left, doc.y - 4, {
      width: doc.page.width - doc.page.margins.left - doc.page.margins.right,
      lineGap: 2,
    });

  const pageOneCards = sectionCards.slice(0, 3);
  const pageTwoCards = sectionCards.slice(3, 6);
  const pageThreeCards = [sectionCards[6], finalCard].filter(Boolean);

  const cardWidth = doc.page.width - doc.page.margins.left - doc.page.margins.right;
  const pageOneY = 180;
  const laterPageY = 120;
  const cardHeight = 170;
  const gapY = 12;

  drawStackedCards(doc, pageOneCards, {
    startY: pageOneY,
    cardWidth,
    cardHeight,
    gapY,
    indexOffset: 0,
  });

  doc.addPage();
  drawHeader(doc, countryName, config.subtitle, false);
  drawStackedCards(doc, pageTwoCards, {
    startY: laterPageY,
    cardWidth,
    cardHeight,
    gapY,
    indexOffset: 3,
  });

  doc.addPage();
  drawHeader(doc, countryName, config.subtitle, false);
  drawStackedCards(doc, pageThreeCards, {
    startY: laterPageY,
    cardWidth,
    cardHeight,
    gapY,
    indexOffset: 6,
  });

  doc.end();

  return finished;
}

async function main() {
  for (const countryConfig of countries) {
    if (!countryConfig || !countryConfig.name || !countryConfig.pdf_path || !Array.isArray(countryConfig.documents)) {
      continue;
    }

    const sections = countryConfig.documents.map((docItem, index) => {
      const title = `${String(docItem.name ?? 'Document Section')}`;
      const lines = String(docItem.description ?? '')
        .split(/\r?\n/)
        .map((line) => line.replace(/^[-*\u2022\s]+/u, '').trim())
        .filter(Boolean);

      return {
        title: `${index + 1}. ${title}`,
        bullets: lines,
      };
    });

    await buildCountryPdf(countryConfig.name, {
      filename: path.basename(String(countryConfig.pdf_path)),
      subtitle: String(countryConfig.pdf_subtitle ?? 'Student Visa Documentation Checklist'),
      summary: String(countryConfig.pdf_summary ?? 'Comprehensive document checklist for admission and visa readiness.'),
      sections,
    });

    const aliases = Array.isArray(countryConfig.pdf_aliases) ? countryConfig.pdf_aliases : [];
    aliases.forEach((aliasName) => {
      const fromPath = path.join(outputDir, path.basename(String(countryConfig.pdf_path)));
      const toPath = path.join(outputDir, path.basename(String(aliasName)));
      if (fs.existsSync(fromPath)) {
        fs.copyFileSync(fromPath, toPath);
      }
    });
  }
}

main()
  .then(() => {
    console.log('Generated enhanced country checklist PDFs with logo and detailed content.');
  })
  .catch((error) => {
    console.error(error);
    process.exitCode = 1;
  });
